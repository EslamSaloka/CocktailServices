<?php

namespace App\Http\Controllers\Main\About;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index() {
        return view('main.pages.about.index');
    }
}
