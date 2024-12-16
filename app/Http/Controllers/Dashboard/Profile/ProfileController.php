<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdatePasswordRequest;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Http\Requests\Dashboard\Profile\UpdateStoreDataRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' =>  __("بيانات الحساب الشخصي"),
            'items' =>  [
                [
                    'title' =>  __("بيانات الحساب الشخصي"),
                    'url'   =>  '#!',
                ]
            ],
        ];
        $user = Auth::user();

        return view('admin.pages.profile.index', compact('breadcrumb', 'user'));
    }

    public function store(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $name = explode(" ",$request->username);
        if(count($name) < 4) {
            return redirect()->back()->withInput($request->all())->withErrors(["username"=>"يجب ان يكون الإسم رباعي"]);
        }
        if($request->hasFile('avatar')){
            $data['avatar'] = (new \App\Support\Image)->FileUpload($request->avatar, 'users');
        }
        Auth::user()->update($data);
        return Redirect::route('admin.profile.index')->with('success', __("تم تحديث البيانات",['item' => __('Profile')]) );
    }

    public function change_password()
    {
        $breadcrumb = [
            'title' =>  __("تغيير كلمه المرور"),
            'items' =>  [
                [
                    'title' =>  __("تغيير كلمه المرور"),
                    'url'   =>  '#!',
                ]
            ],
        ];

        return view('admin.pages.profile.change_password', compact('breadcrumb'));
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        if ( !Hash::check($request->current_password, Auth::user()->password) ) {
            return Redirect::route('admin.change_password.index')->withErrors([
                'current_password' => __('كلمة المرور الحالية غير صحيحه')
            ]);
        }
        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);
        Auth::logout();
        return Redirect::route('admin.change_password.index')->with('success', __("تم تغير كلمة المرور",['item' => __('Password')]) );

    }
}
