<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::latest()->paginate(10);

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
        $manga->load('chapters');

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
}
