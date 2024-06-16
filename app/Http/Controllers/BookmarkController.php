<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmark() {

        $mangas = Auth::user()->followedMangas;

        return view('users.bookmark', ['mangas' => $mangas]);
    }
}
