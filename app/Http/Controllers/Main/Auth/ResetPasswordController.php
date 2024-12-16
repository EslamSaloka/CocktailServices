<?php

namespace App\Http\Controllers\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Auth\ResetPasswordRequest;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function index() {
        if(\Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('main.pages.auth.reset-password');
    }

    public function store(ResetPasswordRequest $request) {
        if(is_null(\Session::get('phoneNumber')))
        {
            return redirect()->route('resetPassword')->with("danger","هذا الجوال غير موجود لدينا");
        }
        $user = User::where(["phone"=>\Session::get('phoneNumber')])->first();
        if(is_null($user)) {
            return redirect()->route('resetPassword')->with("danger","هذا الجوال غير موجود لدينا");
        }
        if($user->otp != $request->otp) {
            return redirect()->back()->with("danger","كود التحقق غير صحيح");
        }
        $user->update([
            "password"  => \Hash::make($request->password)
        ]);
        $request->session()->flash('phoneNumber', null);
        return redirect()->route('login')->with("success","تم تعين كلمة المرور الجديدة بنجاح");
    }
}
