<?php

namespace App\Http\Controllers\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        if(\Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('main.pages.auth.register');
    }

    public function store(RegisterRequest $request) {
        $data = $request->validated();
        $name = explode(" ",$data["username"]);
        if(count($name) < 4) {
            return redirect()->back()->withInput($request->all())->withErrors(["username"=>"يجب ان يكون الإسم رباعي"]);
        }
        $data["password"]   = \Hash::make($request->password);
        $data["email"]      = $request->phone."@cock.com";
        $data["otp"]        = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user               = User::create($data);
        $user->assignRole(User::TYPE_CUSTOMER);
        \Auth::login($user);
        if(env('SMS_SEND',false)) {
            (new \App\Support\Jawaly)->setPhone($user->phone)->setMessage($data['otp'])->send();
        }
        return redirect()->route('otp')->with("success","شكرا لك على الإنضمام معنا");
    }
}
