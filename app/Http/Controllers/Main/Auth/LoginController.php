<?php

namespace App\Http\Controllers\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Auth\OTPRequest;
use App\Http\Requests\Dashboard\Auth\AuthRequest;

class LoginController extends Controller
{
    public function index() {
        if(!\Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('main.pages.auth.login');
    }

    public function store(AuthRequest $request) {
        if( \Auth::attempt($request->validated(), $request->boolean('remember'))) {
            if(!in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
                \Auth::logout();
                return redirect()->route('login')->withErrors(["phone"=>"لايمكنك الدخول من هذه المنطقة"])->withInput();
            }
            if(\Auth::user()->suspend == 1) {
                \Auth::logout();
                return redirect()->route('login')->withErrors(["phone"=>"لقد تم حجب الحساب الخاص بكم من قبل الإداره"])->withInput();
            }
            return redirect()->intended(route('home.index'));
        }
        return redirect()->route('login')->withErrors(["phone"=>"رقم الجوال او كلمة المرور غير صحيحة"]) ->withInput();
    }
}
