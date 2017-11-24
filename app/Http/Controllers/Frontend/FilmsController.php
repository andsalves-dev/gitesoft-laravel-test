<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class FilmsController extends Controller {

    public function index() {
        return view('frontend/films/index');
    }

    public function detail($slug) {
        return view('frontend/films/detail', compact('slug'));
    }

    public function insert() {

    }
}