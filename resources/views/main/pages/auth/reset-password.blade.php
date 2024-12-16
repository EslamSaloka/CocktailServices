<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="منصة كوكتيل خدمات" />
    <meta name="description" content="منصة كوكتيل خدمات" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title> - تعيين كلمة المرور  {{ env('APP_NAME') }} </title>
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
    <div id="pre-loader">
        <img class="img-fluid d-block mx-auto new-color" src="{{ url('/main/images/pre-loader/loader-11.svg') }}">
    </div>
    <section class="login-box-main login-gradient-03 height-100vh page-section-ptb">
        <div class="login-box-main-middle">
            <div class="container">
                <div class="row justify-content-center no-gutter position-relative">
                    <div class="col-lg-2 col-md-4">
                        <div class="login-box-left  white-bg">
                            <img class="logo-small" src="{{ getSettings("logo",asset('/dashboard.svg')) }}" alt="">
                            <ul class="nav">
                                <li class="active"><a href="#"> <i class="fa fa-lock"></i> كلمة المرور الجديدة </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 theme-bg">
                        <div class="login-box pos-r text-white login-box-theme">
                            <h4 class="text-white mb-20">مرحبا بك في منصة كوكتيل خدمات</h4>
                            <p class="mb-10 text-white"> </p>
                            <br><br>
                            <p class="text-white" style="line-height:1.9">يمكنك الان انشاء كلمة المرور الجديدة لحسابك</p>

                            <br>
                            <a class="btn btn-light" href="{{ route('home.index') }}">الذهاب للصفحة الرئيسية</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="login-box pb-50 clearfix white-bg">
                            <h3 class="mb-30">تعيين كلمة المرور الجديدة</h3>
                            <form action="{{ route('resetPassword') }}" method="post">
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">كود التحقق</label>
                                    <input id="name" class="web form-control" type="number" minlength="4" maxlength="4" placeholder="XXXX" name="otp">
                                    @error('otp')
                                        <span class="help-block text-start">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    @if(Session::get('success'))
                                        <span class="text-success">
                                            {{ Session::get('success') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">كلمة المرور الجديدة </label>
                                    <input id="Password" class="Password form-control" type="password" placeholder="********" name="password">
                                    @error('password')
                                        <span class="help-block text-start">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @csrf
                                <button type="submit" class="button">
                                    <span>حفظ البيانات</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                            <div class="section-field">
                                <div class="remember-checkbox mb-30" style="direction:rtl;">
                                    <br>
                                    <form action="{{ route('re-send',\Session::get('phoneNumber')) }}" method="get">
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
    </section>
</div>
    <script src="{{ url('/main/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('/main/js/plugins-jquery.js') }}"></script>
    <script>var plugin_path = 'main/js/';</script>
    <script src="{{ url('/main/js/custom.js') }}"></script>
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
</body>
</html>
