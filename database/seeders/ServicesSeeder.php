<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Bank;
use App\Models\Counter;
use App\Models\Employer;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Service::count() == 0) {
            Service::insert([
                [
                    'name'      => "تسديد متعثرات مالية",
                    'price'     => "10",
                ],
                [
                    'name'      => "تسديد مبلغ إيقاف خدمات",
                    'price'     => "10",
                ],
                [
                    'name'      => "تسديد مخالفات مرورية",
                    'price'     => "10",
                ],
                [
                    'name'      => "شراء سيارة",
                    'price'     => "10",
                ],
                [
                    'name'      => "شراء منزل",
                    'price'     => "10",
                ],
                [
                    'name'      => "شراء مديونية مالية",
                    'price'     => "10",
                ],
            ]);
        }
        if(Testimonial::count() == 0) {
            Testimonial::insert([
                [
                    'name'          => "Ahmed",
                    'message'       => "Excellent Customer support! These guys reply within minutes sometimes and really help you with when you need them. The template itself is very extended as well. Happy with my purchase!",
                ],
                [
                    'name'          => "Oday",
                    'message'       => "Excellent Customer support! These guys reply within minutes sometimes and really help you with when you need them. The template itself is very extended as well. Happy with my purchase!",
                ],
            ]);
        }
        if(Partner::count() == 0) {
            Partner::insert([
                [
                    "logo"  => "partner/partner-1.png"
                ],
                [
                    "logo"  => "partner/partner-2.png"
                ],
                [
                    "logo"  => "partner/partner-3.png"
                ],
                [
                    "logo"  => "partner/partner-4.png"
                ],
                [
                    "logo"  => "partner/partner-5.png"
                ],
                [
                    "logo"  => "partner/partner-6.png"
                ],
                [
                    "logo"  => "partner/partner-7.png"
                ],
                [
                    "logo"  => "partner/partner-8.png"
                ],
            ]);
        }
        if(Slider::count() == 0) {
            Slider::insert([
                [
                    "image"  => "slider/slider-1.mp4"
                ],
                [
                    "image"  => "slider/slider-2.mp4"
                ],
            ]);
        }
        if(Banner::count() == 0) {
            Banner::insert([
                [
                    "video"  => "banner/banner-1.mp4"
                ],
                [
                    "video"  => "banner/banner-2.mp4"
                ],
            ]);
        }
        if(Bank::count() == 0) {
            Bank::insert([
                [
                    'bank_name'         => "بنك الرياض",
                    'account_name'      => "مؤسسة كوكتيل خدمات للتسويق الالكتروني",
                    'account_number'    => "23444456565656",
                    'iban'              => "SAE000033323444456565656",
                ],
                [
                    'bank_name'         => "بنك الرياض",
                    'account_name'      => "مؤسسة كوكتيل خدمات للتسويق الالكتروني",
                    'account_number'    => "23444456565656",
                    'iban'              => "SAE000033323444456565656",
                ],
            ]);
        }
        if(Counter::count() == 0) {
            Counter::insert([
                [
                   "name"   => "شركاء النجاح",
                   "count"   => "50",
                ],
                [
                   "name"   => "الطلبات",
                   "count"   => "700",
                ],
                [
                   "name"   => "العملاء",
                   "count"   => "1000",
                ],
                [
                   "name"   => "جهات التمويل",
                   "count"   => "16",
                ],
            ]);
        }
        if(Employer::count() == 0) {
            Employer::insert([
                [
                   "name"   => "القطاع المدني",
                ],
                [
                   "name"   => "القطاع العسكري",
                ],
                [
                   "name"   => "القطاع الخاص",
                ],
            ]);
        }
    }
}
