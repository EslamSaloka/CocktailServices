<?php

namespace App\Http\Controllers\Main\Profile;

use App\Http\Controllers\Controller;
// Requests
use App\Http\Requests\Main\Profile\UpdateProfileRequest;
use App\Http\Requests\Main\Profile\UpdatePasswordRequest;
use App\Http\Requests\Main\Profile\ActiveAccountRequest;
use Carbon\Carbon;

// Models

class ProfileController extends Controller
{
    public function index() {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
            return redirect()->route("admin.profile.index");
        }
        return view('main.pages.profile.index');
    }

    public function update(UpdateProfileRequest $request) {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
            return redirect()->route("admin.profile.index");
        }
        $name = explode(" ",$request->username);
        if(count($name) < 4) {
            return redirect()->back()->withInput($request->all())->withErrors(["username"=>"يجب ان يكون الإسم رباعي"]);
        }
        \Auth::user()->update($request->validated());
        return redirect()->route('profile.index')->with("success","تم تحديث الحساب الشخصي الخاص بك");
    }

    public function changePassword(UpdatePasswordRequest $request) {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
            return redirect()->route("admin.profile.index");
        }
        \Auth::user()->update([
            "password"  => \Hash::make($request->password)
        ]);
        return redirect()->route('profile.index')->with("success","تم تحديث الحساب الشخصي الخاص بك");
    }

    public function activeAccount(ActiveAccountRequest $request) {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
            return redirect()->route("admin.profile.index");
        }
        if($request->otp != \Auth::user()->otp) {
            return redirect()->route('profile.index')->withErrors(["otp"=>"كود التحقق غير صحيح"]);
        }
        \Auth::user()->update([
            "phone_verified_at"  => Carbon::now()
        ]);
        return redirect()->route('profile.index')->with("success","تم تفعيل الحساب بنجاح");
    }
}
