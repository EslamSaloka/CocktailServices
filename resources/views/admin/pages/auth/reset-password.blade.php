<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(\App::getLocale() == "ar")  style="direction:rtl" @endif>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<!-- Favicon -->
        <link rel="shortcut icon" href="{{ url('favicon.ico')}}" type="image/x-icon">

		<!-- Title -->
		<title>
            @lang('تعيين كلمة المرور') | {{ env('APP_NAME') }} - @lang('Dashboard')
        </title>

		<!-- Base  -->
		<base href="{{ url('/') }}">

		@if(App::isLocale('ar'))
			<!-- Bootstrap css-->
			<link  id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet"/>
		@else
			<!-- Bootstrap css-->
			<link  id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
		@endif

		<!-- Icons css-->
		<link href="{{ asset('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

		@if(App::isLocale('ar'))
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
            <style>
                * {
                    font-family: 'Readex Pro', sans-serif;
                }
            </style>
		@endif
		<style>
			.help-block {
				color: red;
			}
			.rtl .signpages .details:before {
				background-color: #f4f4f4 !important;
			}
            .tx-white-6{
                color: black !important;
            }
			@media only screen and (max-width: 800px) {
				.xxsl {
					background: #f4f4f4 !important;
					color: black !important;
				}
			}
		</style>
	</head>

	<body class="@if(App::isLocale('ar')) rtl @else ltr @endif main-body leftmenu error-1">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page main-signin-wrapper">

			<!-- Row -->
			<div class="row signpages">
				<div class="col-md-12">
					<div class="card">
						<div class="row row-sm">
							<div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
								<div class="mt-5 pt-4 p-2 pos-absolute">
									<img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" style=" position: relative; left: 15px; " class="d-lg-none header-brand-img text-start float-start mb-4 error-logo-light" alt="logo">
									<img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" style=" position: relative; left: 15px; " class=" d-lg-none header-brand-img text-start float-start mb-4 error-logo" alt="logo">
									<div class="clearfix"></div>
									<img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" class="ht-100 mb-0" alt="user" style="margin-right:0px;">
                                    <h5 class="mt-4 text-white"></h5>
                                    <span class="tx-white-6 tx-13 mb-5 mt-xl-0" style="text-align:center;">@lang('يرجى كتابة كود التحقق الذي تم ارساله على رقم جوالك وكلمة المرور الجديدة')</span>
                                </div>
							</div>
							<div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form xxsl">
								<div class="main-container container-fluid">
									<div class="row row-sm">
										<div class="card-body mt-2 mb-2">
											<img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" style=" position: relative; right: 60px; " class=" d-lg-none header-brand-img text-start float-start mb-4" alt="logo">
											<div class="clearfix"></div>
                                            <form style="direction: ltr;" class="form-horizontal" method="POST" action="{{ route('admin.resetPassword.send') }}">
                                                @csrf
												<h5 class="text-start mb-2">
													@lang('إعاده تعيين كلمه المرور')
													<a href="{{ route("admin.forgetPassword.index") }}">
														<i class="ti-arrow-circle-right"></i>
													</a>
												</h5>

                                                <p class="mb-4 text-muted tx-13 ms-0 text-start"></p>

                                                <br>

                                                <div class="mb-3" style="text-align: end; display:none">
                                                    <label for="phone" class="form-label">
                                                        @lang('برجاء إدخال رقم الجوال')
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="phone"
                                                        id="phone"
														style=" direction: rtl; "
                                                        value="{{ request("phone") }}"
                                                        placeholder="@lang('برجاء إدخال رقم الجوال')">
                                                        @error('phone')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                </div>

                                                <div class="mb-3" style="text-align: end;">
                                                    <label for="otp" class="form-label">
                                                        @lang('كود التحقق')
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="otp"
                                                        id="otp"
														style=" direction: rtl; "
                                                        value="{{ old('otp') }}"
                                                        placeholder="@lang('إدخل كود التحقق')">
                                                        @error('otp')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
														@if(Session::get('danger'))
															<span class="text-danger">
																{{ Session::get('danger') }}
															</span>
														@endif
														@if(Session::get('success'))
															<span class="text-success">
																{{ Session::get('success') }}
															</span>
														@endif
                                                </div>

                                                <div class="mb-3" style="text-align: end;">
                                                    <label for="password" class="form-label">
                                                        @lang(' كلمة المرور الجديدة')
                                                    </label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        name="password"
                                                        id="password"
														style=" direction: rtl; "
                                                        value="{{ old('password') }}"
                                                        placeholder="@lang(' كلمة المرور الجديدة')">
                                                        @error('password')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                </div>

                                                <br>
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('حفظ البيانات')</button>
                                                </div>
                                            </form>
                                            <div class="">
                                                <form action="{{ route('re-send',request("phone")) }}" method="get">
                                                    <div class="row">
                                                        <div class="col-md-4" style="float:left;margin-top:25px;" id='countdown'></div>
                                                        <div class="col-md-8 mt-3 d-grid">
                                                            <button class="btn btn-primary waves-effect waves-light" type="submit" disabled id='resend_btn'>إعادة ارسال رمز التحقق</button>
                                                        </div>
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
				<div class="col-md-12">
					<div class="mt-5 text-center">
						<span>@lang('حقوق النشر') © {{ date('Y') }} <a href="#">{{ getSettings("system_name",env('APP_NAME')) }}</a> @lang('جميع الحقوق محفوظة').</span>
                	</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
		<!-- End Page -->

		<!-- Jquery js-->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap js-->
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- Select2 js-->
		<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		@include('admin.layouts.scripts.select2')

		<!-- Perfect-scrollbar js -->
		<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

		<!-- Color Theme js -->
		<script src="{{ asset('assets/js/themeColors.js') }}"></script>

		<!-- Custom js -->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {{-- {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Auth\AuthRequest') !!} --}}

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
