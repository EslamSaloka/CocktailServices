<?php

namespace App\Http\Controllers\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Auth\OTPRequest;

class OTPController extends Controller
{
    public function index() {
        if(!\Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('main.pages.auth.otp');
    }

    public function store(OTPRequest $request) {
        if(!\Auth::check()) {
            return redirect()->route('home.index');
        }
        if(\Auth::user()->otp != $request->otp) {
            return redirect()->back()->withErrors(["otp"=>"كود التحقق غير صحيح"]);
        }
        \Auth::user()->update([
            "phone_verified_at" => \Carbon\Carbon::now()
        ]);
        return redirect()->route('home.index')->with("success","شكرا لك على الإنضمام معنا");
    }
}
