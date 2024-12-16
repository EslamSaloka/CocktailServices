@extends('main.layouts.master')
@section('title') @lang('من نحن') @endsection
@section('PageContent')




<!--=================================page-title-->
<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('about_page_image','/main/images/bg/02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-name">
                    <h1>من نحن</h1>
                    <p>اعرف اكثر عن كوكتيل خدمات</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================page-title -->

@php
    if(\App\Models\About::count() == 0) {
        $page = \App\Models\About::create(["key"=>"about","content"=>"TEST"]);
    } else {
        $page = \App\Models\About::where(["key"=>"about"])->first();
        if(is_null($page)) {
            $page = \App\Models\About::create(["key"=>"about","content"=>"TEST"]);
        }
    }
@endphp

<!--=================================About-->
<section class="page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid full-width mb-20" src="{{ $page->display_image }}" alt="">
            </div>
            <div class="col-lg-6">
                <div class="section-title">
                    <h2 class="title-effect">من نحن</h2>
                    <br>
                    <p style="line-height: 2;font-size: 16px;text-align: right;direction: rtl;margin-top: 20px;">
                        {!! $page->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================================= -->

{{--@include('main.pages.home.more.counter')--}}

<!--=================================Our activities -->

<section class="our-activities gray-bg page-section-ptb">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="accordion shadow">

                    @foreach (\App\Models\About\Data::all() as $item)
                        <div class="acd-group">
                            <a href="#" class="acd-heading">
                                {{ $item->question }}
                            </a>
                            <div class="acd-des">
                                {{ $item->answer }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================our activities -->


@endsection
