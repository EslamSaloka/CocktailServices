<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Customers\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CustomersController extends Controller
{

    public function index()
    {
        $breadcrumb = [
            'title' =>  __("قائمة العملاء"),
            'items' =>  [
                [
                    'title' =>  __("قائمة إداره العملاء"),
                    'url'   =>  '#!',
                ]
            ],
        ];

        $lists = User::whereHas("roles",function($q) {
            return $q->where("name",User::TYPE_CUSTOMER);
        });

        if(request()->has("suspend") && request("suspend") != "-1") {
            $lists = $lists->where("suspend",request("suspend"));
        }
        if(request()->has("name") && request("name") != "") {
            if(is_numeric(request("name"))) {
                $lists = $lists->where("phone","like","%".request("name")."%");
            } else if(filter_var(request("name"), FILTER_VALIDATE_EMAIL)) {
                $lists = $lists->where("email","like","%".request("name")."%");
            } else {
                $lists = $lists->where("username","like","%".request("name")."%");
            }
        }

        $lists = $lists->latest()->paginate();
        return view('admin.pages.customers.index',get_defined_vars());
    }

    public function edit(User $customer)
    {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,$customer->roles()->pluck("name")->toArray())) {
            abort(401);
        }
        if($customer->id == \Auth::user()->id) {
            return redirect()->route('admin.profile.index');
        }
        $breadcrumb = [
            'title' =>  __("تعديل بيانات المستخدم"),
            'items' =>  [
                [
                    'title' =>  __("قائمة إداره المستخدمين"),
                    'url'   => route('admin.users.index'),
                ],
                [
                    'title' =>  __("تعديل بيانات المستخدم"),
                    'url'   =>  '#!',
                ],
            ],
        ];
        return view('admin.pages.customers.edit',get_defined_vars());
    }

    public function update(UpdateUserRequest $request, User $customer)
    {
        $name = explode(" ",$request->username);
        if(count($name) < 4) {
            return redirect()->back()->withInput($request->all())->withErrors(["username"=>"يجب ان يكون الإسم رباعي"]);
        }
        $data = $request->validated();
        if(request()->has('password') && !is_null(request('password'))) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        if( $request->hasFile('avatar') ) {
            $data['avatar'] = (new \App\Support\Image)->FileUpload($request->avatar, 'customers', $customer->avatar);
        }
        $customer->update($data);
        return redirect()->route('admin.customers.index', ['page' => $request->page ?? 1])->with('success', __(":item has been updated.", ['item' => __('Customer')]));
    }

    public function destroy(Request $request,User $customer)
    {
        if (!in_array(\App\Models\User::TYPE_CUSTOMER,$customer->roles()->pluck("name")->toArray())) {
            abort(401);
        }
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', __(":item has been deleted.",['item' => __('Customer')]) );
    }
}
