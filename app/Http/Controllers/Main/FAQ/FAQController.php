<?php

namespace App\Http\Controllers\Main\FAQ;

use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index() {
        return view('main.pages.faq.index');
    }

}
