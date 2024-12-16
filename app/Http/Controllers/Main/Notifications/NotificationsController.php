<?php

namespace App\Http\Controllers\Main\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function index() {
        \Auth::user()->notifications()->where("seen",0)->update([
            "seen"=>1
        ]);
        $lists = \Auth::user()->notifications()->latest()->paginate();
        return view('main.pages.profile.notifications',get_defined_vars());
    }

    public function destroy(Notification $notification) {
        $notification->delete();
        return redirect()->route('profile.notifications.index')->with("success","تم حذف الاشعار");
    }
}
