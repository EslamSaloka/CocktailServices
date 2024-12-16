<?php

namespace App\Http\Controllers\Main\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index() {
        $lists = \Auth::user()->orders()->latest()->paginate();
        return view('main.pages.profile.orders',get_defined_vars());
    }

    public function destroy(Order $order) {
        $order->delete();
        return redirect()->route('profile.orders.index')->with("success","تم حذف الطلب");
    }
}
