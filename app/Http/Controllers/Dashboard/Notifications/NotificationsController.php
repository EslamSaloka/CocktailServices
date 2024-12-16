<?php

namespace App\Http\Controllers\Dashboard\Notifications;

use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Notifications\CreateRequest;
// Models
use App\Models\User;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            'title' =>  __("إرسال إشعارات"),
            'items' =>  [
                [
                    'title' =>  __("إرسال إشعارات"),
                    'url'   =>  '#!',
                ]
            ],
        ];
        $users = User::whereHas("roles",function($q) {
            return $q->where("name",User::TYPE_CUSTOMER);
        })->get();
        return view('admin.pages.notifications.index',[
            'breadcrumb' => $breadcrumb,
            'users'      => $users,
        ]);
    }

    public function store(CreateRequest $request) {
        $data = $request->validated();
        if(in_array("0",request("users",[]))) {
            $users = User::whereHas("roles",function($q) {
                return $q->where("name",User::TYPE_CUSTOMER);
            })->get();
        } else {
            $users = User::whereIn("id",request("users",[]))->whereHas("roles",function($q) {
                return $q->where("name",User::TYPE_CUSTOMER);
            })->get();
        }
        foreach($users as $user) {
            Notification::create([
                'user_id'       =>  $user->id,
                'title'         =>  $data["title"],
                'descriptions'  =>  $data["message"],
                'order_id'      =>  0,
            ]);
        }
        return redirect()->route("admin.notifications.index")->with('success',__('تم إرسال الإشعار بنجاح'));
    }
}
