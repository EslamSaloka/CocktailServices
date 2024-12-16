<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        return view('admin.pages.home.index', [
            "statistic" => $this->statistic(),
        ]);
    }

    private function statistic() {
        $return  = [];

        $return[] = [
            "title" => "الإدارة",
            "count" => \App\Models\User::whereHas("roles",function($q){
                return $q->where("name",\App\Models\User::TYPE_ADMIN);
            })->count(),
            "icon"  => 'ti-user',
        ];
        $return[] = [
            "title" => "العملاء",
            "count" => \App\Models\User::whereHas("roles",function($q){
                return $q->where("name",\App\Models\User::TYPE_CUSTOMER);
            })->count(),
            "icon"  => 'ti-user',
        ];
        $return[] = [
            "title" => "الخدمات",
            "count" => \App\Models\Service::count(),
            "icon"  => 'ti-list',
        ];
        $return[] = [
            "title" => "رسائل التواصل",
            "count" => \App\Models\Contact::where("seen",0)->count(),
            "icon"  => 'ti-email',
        ];
        $return[] = [
            "title" => "الأسئلة الشائعه",
            "count" => \App\Models\Faq::count(),
            "icon"  => 'ti-help',
        ];
        $return[] = [
            "title" => "جهات العمل",
            "count" => \App\Models\Employer::count(),
            "icon"  => 'ti-pie-chart',
        ];
        $return[] = [
            "title" => "الصور المتحركة",
            "count" => \App\Models\Slider::count(),
            "icon"  => 'ti-gallery',
        ];
        $return[] = [
            "title" => "الحسابات البنكية",
            "count" => \App\Models\Bank::count(),
            "icon"  => 'ti-list',
        ];
        $return[] = [
            "title" => "الفيديوهات",
            "count" => \App\Models\Banner::count(),
            "icon"  => 'ti-video-camera',
        ];
        $return[] = [
            "title" => "جهات التمويل",
            "count" => \App\Models\Entitle::count(),
            "icon"  => 'ti-money',
        ];
        $return[] = [
            "title" => "الإحصائيات",
            "count" => \App\Models\Counter::count(),
            "icon"  => 'ti-bar-chart-alt',
        ];
        $return[] = [
            "title" => "شركاء النجاح",
            "count" => \App\Models\Partner::count(),
            "icon"  => 'ti-face-smile',
        ];
        $return[] = [
            "title" => "أراء العملاء",
            "count" => \App\Models\Testimonial::count(),
            "icon"  => 'ti-medall',
        ];
        $return[] = [
            "title" => "مسميات جهات العمل",
            "count" => \App\Models\Employer::count(),
            "icon"  => 'ti-pie-chart',
        ];
        $return[] = [
            "title" => "الطلبات",
            "count" => \App\Models\Order::count(),
            "icon"  => 'ti-agenda',
        ];
        $return[] = [
            "title" => "الطلبات الجديدة",
            "count" => \App\Models\Order::where("action",0)->count(),
            "icon"  => 'ti-agenda',
        ];
        $return[] = [
            "title" => "الطلبات المقبوله",
            "count" => \App\Models\Order::where("action",1)->count(),
            "icon"  => 'ti-agenda',
        ];
        $return[] = [
            "title" => "الطلبات المرفوضة",
            "count" => \App\Models\Order::where("action",2)->count(),
            "icon"  => 'ti-agenda',
        ];
        return $return;
    }

    public function logout() {
        \Auth::logout();
        return redirect()->back();
    }
}
