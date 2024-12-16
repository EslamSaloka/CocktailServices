@extends('main.layouts.master')
@section('title')
    حسابي الشخصي
@endsection
@section('PageContent')



    <!--=================================page-title-->
    <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('profile_page_image','/main/images/bg/02.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-name">
                        <h1>الملف الشخصي</h1>
                        <p>يمكنك تحديث بياناتك الشخصية </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================page-title -->


    @if (is_null(\Auth::user()->phone_verified_at))

        <section class="page-section-ptb bg-overlay-white-70 login-signup parallax" style="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 position-relative">
                        <div class="tab tab-border nav-center">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item" style="direction:rtl;">
                                    <a class="nav-link active show" id="change-password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false"><i class="fa fa-lock"></i> تفعيل الحساب </a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active show" id="password" role="tabpanel" aria-labelledby="change-password-tab">
                                    <div class="login-box-02 white-bg">
                                        <div class="pb-50 clearfix">
                                            <h4 class="mb-30"></h4>
                                            <form action="{{ route('profile.activeAccount') }}" method="POST">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="Code">
                                                        كود التفعيل
                                                    </label>
                                                    <input id="Code" class="Password form-control" type="text" placeholder="******" name="otp">
                                                    @error("otp")
                                                    <span class="help-block">
                                                    {{ $message }}
                                                </span>
                                                    @enderror
                                                </div>
                                                <div class="d-grid">
                                                    @csrf
                                                    <button type="submit" class="button d-flex justify-content-center align-items-center">
                                                        <span class="me-1">تـــأكيد</span>
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="remember-checkbox mb-30" style="direction:rtl;">
                                                <br>
                                                <form action="{{ route('re-send',\Auth::user()->id) }}" method="get">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <button class="btn btn-block btn-dark" type="submit" disabled id='resend_btn'>إعادة ارسال رمز التحقق</button>
                                                        </div>
                                                        <div class="col-md-4" style="float:left;margin-top:8px;" id='countdown'></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    @else
        <!--=================================profile-->
        <section class="page-section-ptb bg-overlay-white-70 login-signup parallax" style="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 position-relative">
                        <div class="tab tab-border nav-center">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item" style="direction:rtl;">
                                    <a class="nav-link @error("password") active show @enderror" id="change-password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false"><i class="fa fa-lock"></i> تغيير كلمة المرور </a>
                                </li>
                                @error("password")
                                @else
                                    @enderror
                                    <li class="nav-item" style="direction:rtl;">
                                        <a class="nav-link @error("password")
                                        @else
                                            active show
@enderror " id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"> <i class="fa fa-user"></i> الملف الشخصي</a>
                                    </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade @error("password")
                                @else
                                    active show
@enderror" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="login-box-02 white-bg">
                                        <div class="pb-50 clearfix">
                                            <h4 class="mb-30"> </h4>

                                            <form action="{{ route('profile.update') }}" method="POST">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">الاسم رباعي</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->username }}" type="text"  name="username">
                                                    @error("username")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">رقم الهوية</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->id_number }}" type="text"  name="id_number">
                                                    @error("id_number")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">رقم الجوال</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->phone }}" type="text"  name="phone">
                                                    @error("phone")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">المنطقة</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->area }}" type="text"  name="area">
                                                    @error("area")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">مسمى جهة العمل</label>
                                                    <select style="text-align:right;" class="form-control" id="bank" name="employer_id">
                                                        <option disabled>اختر مسمى جهة العمل</option>
                                                        @foreach (\App\Models\Employer::all() as $item)
                                                            <option @if (\Auth::user()->employer_id == $item->id)
                                                                    @selected(true)
                                                                    @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">اسم جهة العمل</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->employer_name }}" type="text"  name="employer_name">
                                                    @error("employer_name")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">عدد سنوات العمل</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->employer_years }}" type="text" min="1"  name="employer_years">
                                                    @error("employer_years")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="name">مقدار الراتب</label>
                                                    <input id="name" class="web form-control" value="{{ \Auth::user()->salary }}" type="text" min="1"  name="salary">
                                                    @error("salary")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                @csrf
                                                <button type="submit" class="button d-flex justify-content-center align-items-center">
                                                    <span class="me-1">حفظ البيانات</span>
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade @error("password")
                                    active show
                                    @enderror" id="password" role="tabpanel" aria-labelledby="change-password-tab">
                                    <div class="login-box-02 white-bg">
                                        <div class="pb-50 clearfix">
                                            <h4 class="mb-30"></h4>
                                            <form action="{{ route('profile.password.update') }}" method="POST">
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="Password">كلمة المرور الجديدة</label>
                                                    <input id="Password" class="Password form-control" type="password" placeholder="********" name="password">
                                                    @error("password")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="section-field mb-20">
                                                    <label class="mb-10" for="Password">تأكيد كلمة المرور</label>
                                                    <input id="Password" class="Password form-control" type="password" placeholder="********" name="password_confirmation">
                                                    @error("password_confirmation")
                                                    <span class="help-block">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="d-grid">
                                                    @csrf
                                                    <button type="submit" class="button d-flex justify-content-center align-items-center">
                                                        <span class="me-1">حفظ البيانات</span>
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================profile-->
    @endif


@endsection
@push('scripts')
    <script>
        function countdown( elementName, minutes, seconds ) {
            var element, endTime, hours, mins, msLeft, time;
            function twoDigits(n)
            {
                return (n <= 9 ? "0" + n : n);
            }
            function updateTimer()
            {
                msLeft = endTime - (+new Date);
                if ( msLeft < 1000 ) {
                    element.innerHTML='';
                    $('#resend_btn').removeAttr('disabled');
                } else {
                    time = new Date( msLeft );
                    hours = time.getUTCHours();
                    mins = time.getUTCMinutes();
                    element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
                    setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
                }
            }
            element = document.getElementById( elementName );
            endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
            updateTimer();
        }
        countdown( "countdown", 1, 0 );
    </script>
@endpush
