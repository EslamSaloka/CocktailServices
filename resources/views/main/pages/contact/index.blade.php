@extends('main.layouts.master')
@section('title') @lang('تواصل معنا') @endsection
@section('PageContent')


    <!--=================================page-title-->
    <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('contact_page_image','/main/images/bg/02.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-name">
                        <h1>تواصل معنا</h1>
                        <p>نسعد بتواصلكم معنا على مدار الساعة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================page-title -->


    <!--=================================contact-->
    <section class="contact white-bg page-section-ptb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="title-effect">كن على تواصل دائم معنا</h2>
                        <p>نحن في خدمتكم</p>
                    </div>
                </div>
            </div>
            <div class="touch-in white-bg">
                <div class="row">
                    <div class="col-lg-4 col-md-4 sm-mb-30">
                        <div class="contact-box text-center h-100">
                            <i class="fa fa-map theme-color"></i>
                            <h5 class="uppercase mt-20">العنوان</h5>
                            <p class="mt-20">{{ getSettings('address_name') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 sm-mb-30">
                        <div class="contact-box text-center h-100">
                            <i class="fa fa-phone theme-color"></i>
                            <h5 class="uppercase mt-20">رقم الجوال</h5>
                            <p class="mt-20"> {{ getSettings('phone') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 sm-mb-30">
                        <div class="contact-box text-center h-100">
                            <i class="fa fa-envelope theme-color"></i>
                            <h5 class="uppercase mt-20">البريد الالكتروني</h5>
                            <p class="mt-20">{{ getSettings('email') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="divider dashed"></div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4 class="mt-50 mb-30">يمكنك التواصل معنا عبر ارسال استفسارتكم من خلال النموذج بالاسفل</h4>
                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-sm-12" style="text-align:right;direction: rtl">
                    <form  method="post" action="{{ route('contact.store') }}">
                        <div class="contact-form clearfix">

                            <div class="row">
                                <div class="col-sm-6">
                                    <input value="{{ old('name') }}" id="name" type="text" placeholder="الاسم رباعي" class="form-control"  name="name">
                                    @error("name")
                                        <span class="help-blocks">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <input value="{{ old('phone') }}" type="number" placeholder="رقم الجوال" class="form-control" name="phone">
                                    @error("phone")
                                        <span class="help-blocks">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="section-field textarea">
                                <textarea class="form-control input-message" placeholder="نص الرسالة " rows="7" name="message">{!! old('message') !!}</textarea>
                                @error("message")
                                    <span class="help-blocks">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="section-field submit-button" style="float:right;">
                                @csrf
                                <button id="submit" name="submit" type="submit" value="Send" class="button"> إرسال الان </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!--=================================contact-->



@endsection
@push('scripts')

@endpush
