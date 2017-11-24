<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Genre;
use Illuminate\Support\Facades\Auth;

class FilmsController extends Controller {

    public function index() {
        return view('frontend/films/index');
    }

    public function detail($slug) {
        return view('frontend/films/detail', compact('slug'));
    }

    public function insert() {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('warning_message', 'You must be logged-in to post a new film.');;
        }

        return view('frontend/films/insert')->with('genres', Genre::all()->toArray());
    }
}