<?php

namespace App\Http\Controllers\Main\Services;

use App\Http\Controllers\Controller;
// Requests
use App\Http\Requests\Main\Services\StoreNewOrderRequest;
// Models
use App\Models\Service;
use App\Models\Order;

class ServicesController extends Controller
{
    public function show(Service $service) {
        if(is_null(\Auth::user()->phone_verified_at)) {
            return redirect()->back()->with("danger","عذرا ولكن برجاء تفعيل الحساب اولا");
        }
        if(\Auth::user()->suspend == 1) {
            return redirect()->back()->with("danger","عذرا ، تم إيقاف الحساب الخاص بك من قبل الإدارة");
        }
        return view('main.pages.services.index',['service'=>$service,"banks"=>\App\Models\Bank::all()]);
    }

    public function store(StoreNewOrderRequest $request,Service $service) {
        if(is_null(\Auth::user()->phone_verified_at)) {
            return redirect()->back()->with("danger","عذرا، الرجاء تفعيل الحساب اولا");
        }
        if(\Auth::user()->suspend == 1) {
            return redirect()->back()->with("danger","عذرا ، تم إيقاف الحساب الخاص بك من قبل الإدارة");
        }
        $data = $request->validated();
        if($request->hasFile('transfer_image')){
            $data['transfer_image'] = (new \App\Support\Image)->FileUpload($data['transfer_image'],"orders");
        }
        $data['user_id']        = \Auth::user()->id;
        $data['service_id']     = $service->id;
        $order = \App\Models\Order::create($data);
        $order->update([
            "id_hash"   => rand(1000,99999).time().$order->id
        ]);
        if(env('SMS_SEND',false)) {
            if(env('SMS_NEW_ORDER_TO_ADMIN',false)) {
                (new \App\Support\Jawaly)->setPhone(getSettings('phone'))->setMessage("لديك طلب تمويل جديد")->send();
            }
        }
        \App\Models\Notification::create([
            'user_id'       => 0,
            'title'         => "طلب جديد من قبل ".\Auth::user()->username,
            'descriptions'  => "تم إنشاء طلب جديد خدمة $service->name رقم الطلب $order->id",
            'order_id'      => $order->id,
        ]);
        return redirect()->route('services.show',$service->id)->with("success","تم استقبال طلبك بنجاح وجاري مراجعته")->with("link",route('profile.orders.index'));
    }
}
