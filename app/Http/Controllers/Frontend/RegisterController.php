<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class RegisterController extends Controller {

    public function index() {
        return view('frontend/register/index');
    }
}