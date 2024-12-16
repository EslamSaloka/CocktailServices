<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="منصة كوكتيل خدمات" />
<meta name="description" content="منصة كوكتيل خدمات" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>@yield('title') - {{ env('APP_NAME') }}</title>
<!-- Base  -->
<base href="{{ url('/') }}">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ url('favicon.ico')}}" type="image/x-icon">

<!-- font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
<!-- Plugins -->
<link rel="stylesheet" type="text/css" href="{{ url('main/css/plugins-css.css') }}" />
<!-- revoluation -->
<link rel="stylesheet" type="text/css" href="{{ url('main/revolution/css/settings.css') }}" media="screen" />
<!-- Typography -->
<link rel="stylesheet" type="text/css" href="{{ url('main/css/typography.css') }}" />
<!-- Shortcodes -->
<link rel="stylesheet" type="text/css" href="{{ url('main/css/shortcodes/shortcodes.css') }}" />
<!-- Style -->
<link rel="stylesheet" type="text/css" href="{{ url('main/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('main/css/shop.css') }}"  />
<!-- Responsive -->
<link rel="stylesheet" type="text/css" href="{{ url('main/css/responsive.css') }}" />


@if(App::isLocale('ar'))
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Readex Pro', sans-serif;
        }
        .help-block {
            color: red;
            font-size: 14px;
            float: none;
            margin-bottom: 25px;
            direction: rtl;
            text-align: right;
        }
        .help-blocks{
            color: red;
            font-size: 14px;
            float: right;
            margin-bottom: 20px;
            margin-top: -10px;
            direction: rtl;
            text-align: right;
        }
        .swal2-styled {
            background: #2dc4ea !important;
            color: black !important;
            border: 0px !important;
            box-shadow: #2dc4ea !important;
        }

        .swal2-styled.swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgb(45 197 234 / 44%) !important;
        }
        .alert-warning{
            color: #000000;
            background-color: #2dc5ea75;
            border-color: #2dc5ea75;
        }
    </style>
@endif
