@extends('main.layouts.master')
@section('title') @lang('الشروط و الأحكام') @endsection
@section('PageContent')




<!--=================================page-title-->
<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('terms_page_image','/main/images/bg/02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-name">
                    <h1>الشروط و الأحكام</h1>
                    <p>اعرف اكثر عن كوكتيل خدمات</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================page-title -->

@php
    if(\App\Models\About::count() == 0) {
        $page = \App\Models\About::create(["key"=>"terms","content"=>"TEST"]);
    } else {
        $page = \App\Models\About::where(["key"=>"terms"])->first();
        if(is_null($page)) {
            $page = \App\Models\About::create(["key"=>"terms","content"=>"TEST"]);
        }
    }
@endphp

<!--=================================About-->
<section class="page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="title-effect">الشروط و الأحكام</h2>
                    <br>
                    <p style="line-height: 2;font-size: 16px;text-align: right;direction: rtl;margin-top: 20px;">
                        {!! $page->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
