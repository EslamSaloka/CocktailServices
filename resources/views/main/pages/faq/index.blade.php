@extends('main.layouts.master')
@section('title') @lang('الأسئلة الشائعة') @endsection
@section('PageContent')

<!--=================================page-title-->
<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('faq_page_image','/main/images/bg/02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-name">
                    <h1>الأسئلة الشائعة</h1>
                    <p>هنا تجد اجابات معظم الأسئلة المتكررة </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================page-title -->

<!--=================================faq-->
<section class="faq white-bg page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h6>لديك سؤال؟</h6>
                    <h2 class="title-effect">الأسئلة الشائعة</h2>
                    <p>لا تقلق ، قمنا بجمع معظم الاسئلة المتكررة والاجابة عليها هنا</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="accordion shadow">

                    @foreach (\App\Models\Faq::all() as $item)
                        <div class="acd-group acd">
                            <a href="#" class="acd-heading">
                                {{ $item->question }}
                            </a>
                            <div class="acd-des">
                                <p>
                                    {{ $item->answer }}
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center mt-40">
                <h6> اذا لم يتم الاجابة على سؤالك يمكنك التواصل معنا  <a class="theme-color" href="{{ route('contact') }}"> من هنا</a> </h6>
            </div>
        </div>
    </div>
</section>
<!--=================================faq-->


@endsection
