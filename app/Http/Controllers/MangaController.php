<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::latest()->paginate(10);

        return view('mangas.index', ['mangas' => $mangas]);
    }
}
