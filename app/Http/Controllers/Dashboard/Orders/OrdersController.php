<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Http\Controllers\Controller;
use App\Models\Entitle;
// Request
use Illuminate\Http\Request;
// Models
use App\Models\Order;

class OrdersController extends Controller
{
    protected $fileName = "orders";
    protected $controllerName = "الطلبات";
    protected $routeName = "orders";

    public function index() {
        $breadcrumb = [
            'title' =>  __("قائمة $this->controllerName"),
            'items' =>  [
                [
                    'title' =>  __("قائمة $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ]
            ],
        ];
        $lists = new Order;
        if(request()->has("user_id") && request("user_id") != -1) {
            $lists = $lists->where("user_id",request("user_id"));
        }
        if(request()->has("order_id") && request("order_id") != '') {
            $lists = $lists->where("id",request("order_id"));
        }
        if(request()->has("service_id") && request("service_id") != -1) {
            $lists = $lists->where("service_id",request("service_id"));
        }
        if(request()->has("seen") && request("seen") != -1) {
            $lists = $lists->where("seen",request("seen"));
        }
        if(request()->has("action") && request("action") != -1) {
            $lists = $lists->where("action",request("action"));
        }
        if(request()->has("from") && request("from") != '') {
            if(request()->has("to") && request("to") != '') {
                if(request("from") == request("to")) {
                    $lists  = $lists->whereDate("created_at",\Carbon\Carbon::parse(request("from")));
                } else {
                    $lists  = $lists->whereBetween("created_at",[\Carbon\Carbon::parse(request("from")),\Carbon\Carbon::parse(request("to"))]);
                }
            }
        }

        if(request()->has("export")) {
            $type = 'attachment; filename="orders-'.date("d_m_Y").'.xls"';
            $content = view("admin.pages.$this->fileName.excel", ["lists"=>$lists->latest()->get()]);
            $status = 200;
            $headers = [
                'Content-Type: application/vnd.ms-excel; charset=utf-8',
                'Content-type: application/octet-stream',
                'Content-Disposition' => $type,
            ];
            $response = response($content, $status, $headers);
            return $response;
        }
        $lists = $lists->latest()->paginate();
        return view("admin.pages.$this->fileName.index",get_defined_vars());
    }

    public function show(Request $request,Order $order) {
        if($order->seen == 0) {
            $order->update([
                'seen'    => 1
            ]);
        }
        $breadcrumb = [
            'title' =>  __("عرض الطلب"),
            'items' =>  [
                [
                    'title' =>  __("قائمة $this->controllerName"),
                    'url'   =>  route("admin.$this->routeName.index"),
                ],
                [
                    'title' =>  __("عرض الطلب"),
                    'url'   =>  '#!',
                ],
            ],
        ];
        return view("admin.pages.$this->fileName.show",get_defined_vars());
    }

    public function update(Request $request,Order $order) {
        if($request->action == 0) {
            return redirect()->back()->with('danger',__('حالة الطلب بالفعل قيد المراجعة ، برجاء إختيار حالة أخري'));
        }
        $order->update([
            "action"    => $request->action
        ]);
        if($order->action == 1) {
            \App\Models\Notification::create([
                'user_id'       => $order->user->id,
                'title'         => "تنبيه بتغيير حالة الطلب",
                'descriptions'  => "لقد تم قبول طلبك رقم $order->id",
                'order_id'      => $order->id,
            ]);
        } else {
            \App\Models\Notification::create([
                'user_id'       => $order->user->id,
                'title'         => "تنبيه بتغيير حالة الطلب",
                'descriptions'  => "لقد تم رفض طلبك رقم $order->id",
                'order_id'      => $order->id,
            ]);
        }
        return redirect()->back()->with('success',__('تم تغير حالة الطلب'));
    }

    public function destroy(Order $order) {
        $order->delete();
        return redirect()->route("admin.$this->routeName.index")->with('success',__('تم حذف البيانات'));
    }

    public function showPdf($order = null) {
        $order = Order::where("id_hash",$order)->first();
        if(is_null($order)) {
            abort(404);
        }
        return view('admin.pages.orders.table',["order"=>$order]);
    }

    public function sendPDF(Order $order,Entitle $entitle) {
        $my     = $order->entitles()->pluck("entities_id")->toArray();
        $data   = array_merge($my,[$entitle->id]);
        $order->entitles()->sync($data);


        $my = $order->entitles()->pluck("entities_id")->toArray();
        $entitles = \App\Models\Entitle::whereHas("services",function($q)use($order){
            return $q->where("service_id",$order->service_id);
        })->get();
        if (count($my) == count($entitles)) {
            \App\Models\Notification::create([
                'user_id'       => $order->user->id,
                'title'         => "تنبيه بتغيير حالة الطلب ",
                'descriptions'  => "طلبك رقم ( $order->id ) تم إرساله الي جميع جهات التمويل وسوف يتم التواصل معك في اسرع وقت",
                'order_id'      => $order->id,
            ]);
        }
        return redirect("https://wa.me/".$entitle->whatsapp."?text=".route("pdf",$order->id_hash));
    }
}
