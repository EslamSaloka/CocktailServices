<?php

namespace App\Http\Controllers\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Auth\ForgetPasswordRequest;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function index() {
        if(\Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('main.pages.auth.forget-password');
    }

    public function store(ForgetPasswordRequest $request) {
        $user = User::where(["phone"=>$request->phone])->first();
        if(is_null($user)) {
            return redirect()->back()->withErrors(["phone"=>"هذا الجوال غير موجود لدينا"])->withInput();
        }
        if(!in_array(User::TYPE_CUSTOMER,$user->roles()->pluck("name")->toArray())) {
            return redirect()->back()->withErrors(["phone"=>"لا يوجد لديك صلاحيه التواجد هنا"])->withInput();
        }
        $otp = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user->update([
            "otp"   => $otp
        ]);
        if(env('SMS_SEND',false)) {
            (new \App\Support\Jawaly)->setPhone($user->phone)->setMessage($otp)->send();
        }
        \Session::put('phoneNumber',$user->phone);
        return redirect()->route('resetPassword')->with("success","تم إرسال كود التحقق علي الجوال الخاص بك");
    }
}
