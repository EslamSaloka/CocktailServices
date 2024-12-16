<?php

namespace App\Http\Controllers\Main\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        return view('main.pages.home.index');
    }

    public function logout() {
        \Auth::logout();
        return redirect()->back();
    }
}
