<?php

namespace App\Http\Controllers;

use App\Models\ChapterView;
use Illuminate\Http\Request;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index()
    {
        $latestChapters = DB::table('chapters as c1')
            ->select('c1.manga_id', DB::raw('MAX(c1.id) as latest_chapter_id'))
            ->groupBy('c1.manga_id');

        $mangas = Manga::select('mangas.*')
            ->joinSub($latestChapters, 'latest_chapters', function($join) {
                $join->on('mangas.id', '=', 'latest_chapters.manga_id');
            })
            ->with(['chapters' => function($query) {
                $query->orderByDesc('id')->limit(5);
            }, 'chapters.links'])
            ->orderByDesc('latest_chapters.latest_chapter_id')
            ->paginate(10);

        return view('mangas.index', ['mangas' => $mangas]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images', $request->image);
        }

        Manga::create([
            'title' => $request->input('title'),
            'image' => $path,
        ]);

        return redirect()->route('mangas.index');
    }

    public function show(Manga $manga)
    {
        $userId = Auth::id();

        $manga->load(['chapters.links', 'chapters.views' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);

        return view('mangas.show', ['manga' => $manga]);
    }

    public function follow(Manga $manga)
    {
        $manga->follow(Auth::user());
        return redirect()->back()->with('success', 'You are now following this manga.');
    }

    public function unfollow(Manga $manga)
    {
        $manga->unfollow(Auth::user());
        return redirect()->back()->with('success', 'You are no longer following this manga.');
    }

    public function logView(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'chapter_id' => 'required|integer|exists:chapters,id',
        ]);

        $chapterView = ChapterView::updateOrCreate(
            ['user_id' => $validated['user_id'], 'chapter_id' => $validated['chapter_id']],
            ['viewed' => true]
        );

        return response()->json(['status' => 'success', 'data' => $chapterView]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $mangas = Manga::where('title', 'LIKE', '%' . $query . '%')->select('id', 'title', 'image')->limit(10)->get();
        return response()->json($mangas);
    }

    public function random()
    {
        $random = Manga::inRandomOrder()->first();

        if ($random) {
            return redirect()->route('mangas.show', ['manga' => $random->id]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }
}
