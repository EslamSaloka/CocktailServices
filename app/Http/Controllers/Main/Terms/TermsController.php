<?php

namespace App\Http\Controllers\Main\Terms;

use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function index() {
        return view('main.pages.terms.index');
    }
}
