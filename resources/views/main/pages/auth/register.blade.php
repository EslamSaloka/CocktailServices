<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="منصة كوكتيل خدمات" />
    <meta name="description" content="منصة كوكتيل خدمات" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title> - حساب جديد  {{ env('APP_NAME') }} </title>
    <link rel="shortcut icon" href="{{ url('favicon.ico')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/main/css/plugins-css.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/main/css/typography.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/main/css/shortcodes/shortcodes.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/main/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/main/css/responsive.css') }}" />
    <style>
        .help-block {
            color: red;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img class="img-fluid d-block mx-auto new-color" src="{{ url('/main/images/pre-loader/loader-11.svg') }}">
    </div>

    <!--=================================
     preloader -->

    <!--=================================
     signup-->

    <section class="login-box-main login-gradient-03 height-100vh page-section-ptb">
        <div class="login-box-main-middle">
            <div class="container">
                <div class="row justify-content-center no-gutter">
                    <div class="col-lg-2 col-md-4 position-relative">
                        <div class="login-box-left  white-bg">
                            <img class="logo-small" src="{{ getSettings("logo",asset('/dashboard.svg')) }}" alt="">
                            <ul class="nav">
                                <li><a href="{{ route('login') }}"> <i class="fa fa-sign-in"></i> تسجيل الدخول</a></li>
                                <li class="active"> <a href="#"> <i class="fa fa-pencil-square"></i> مستخدم جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 theme-bg">
                        <div class="login-box pos-r text-white login-box-theme">
                            <h4 class="text-white mb-20">مرحبا بك في منصة كوكتيل خدمات</h4>
                            <p class="mb-10 text-white"> </p>
                            <br><br>
                            <p class="text-white" style="line-height:1.9">يمكنك الان فتح حساب جديد لتتمكن من الإستفادة بجميع خدمات المنصة</p>

                            <br>
                            <a class="btn btn-light" href="{{ route('home.index') }}">الذهاب للصفحة الرئيسية</a>

                            <ul class="list-unstyled pos-bot pb-40">
                                <li class="list-inline-item"><a class="text-white" href="{{ route('terms') }}"> الإطلاع على الشروط والأحكام</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 position-relative">
                        <div class="login-box pb-50 clearfix white-bg">
                            <h3 class="mb-30">مستخدم جديد</h3>
                            <form action="{{ route('register') }}" method="POST">
                                <div class="row">
                                    <div class="section-field mb-20">
                                        <input type="text" value="{{ old('username') }}" placeholder="الاسم رباعي" class="form-control" name="username">
                                        @error("username")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="section-field mb-20 col-sm-6">
                                        <input id="name" value="{{ old('id_number') }}" class="web form-control" type="number" placeholder="رقم الهوية" name="id_number">
                                        @error("id_number")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="section-field mb-20 col-sm-6">
                                        <input id="name" value="{{ old('phone') }}" class="web form-control" type="number" placeholder="05XXXXXXXX" name="phone">
                                        @error("phone")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="section-field mb-20">
                                    <input type="text" value="{{ old('area') }}" placeholder="المنطقة" class="form-control" name="area">
                                    @error("area")
                                        <span class="help-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="ssection-field mb-20">
                                    <div class="field-widget">
                                        <select style="text-align:right;" class="form-control" id="bank" name="employer_id">
                                            <option disabled>اختر مسمى جهة العمل</option>
                                            @foreach (\App\Models\Employer::all() as $item)
                                                <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("employer_id")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <input type="text" value="{{ old('employer_name') }}" placeholder="اسم جهة العمل" class="form-control" name="employer_name">
                                    @error("employer_name")
                                        <span class="help-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="section-field mb-20 col-sm-6">
                                        <input id="number" value="{{ old('employer_years') }}" class="web form-control" type="number" min="1" placeholder="عدد سنوات العمل" name="employer_years">
                                        @error("employer_years")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="section-field mb-20 col-sm-6">
                                        <input id="number" value="{{ old('salary') }}" class="web form-control" type="number" min="1" placeholder="مقدار الراتب" name="salary">
                                        @error("salary")
                                            <span class="help-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <input id="Password" class="Password form-control" type="password" placeholder="كلمة المرور" name="password">
                                    @error("password")
                                        <span class="help-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                @csrf
                                <button type="submit" class="button">
                                    <span>فتح حساب جديد</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <script src="{{ url('/main/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('/main/js/plugins-jquery.js') }}"></script>
    <script>var plugin_path = 'main/js/';</script>
    <script src="{{ url('/main/js/custom.js') }}"></script>
</body>
</html>
