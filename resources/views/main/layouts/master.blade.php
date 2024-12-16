<!DOCTYPE html>
<html lang="en">
<head>
    @include('main.layouts.inc.head')
</head>

<body>
    <div class="wrapper">

        <div id="pre-loader">
            <img class="img-fluid d-block mx-auto new-color" src="{{asset('main/images/pre-loader/loader-11.svg')}}">
        </div>

        @include('main.layouts.inc.header')
        @yield('PageContent')
        @include('main.layouts.inc.footer')
    </div>
</body>
</html>
