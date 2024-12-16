<!--=================================our-services -->
<section class="our-services page-section-ptb gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h2 class="title-effect">خدمات منصة كوكتيل خدمات</h2>
                </div>
            </div>
        </div>
        <div class="row" style=" direction: rtl; ">
            @foreach (\App\Models\Service::all() as $s)
                <div class="col-lg-4 col-md-4">
                    <div class="feature-text box-shadow text-center mb-30 white-bg">
                        <div class="fature-info">
                            <h4 class="text-back pt-20 pb-10">
                                {{ $s->name }}
                            </h4>
                            @if (\Auth::check())
                                @if (is_null(\Auth::user()->phone_verified_at))
                                    <a class="clickMy1 button mt-20">اطلب الان</a>
                                @else
                                    <a class="button mt-20" href="{{ route('services.show',$s->id) }}">اطلب الان</a>
                                @endif
                            @else
                                <a class="clickMy button mt-20">اطلب الان</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--================================our-services -->

@push('scripts')
    @if (!\Auth::check())
        <script>
            $(".clickMy").click(function() {
                Swal.fire({
                    title: 'تنبيه',
                    text: 'الرجاء تسجيل الدخول أولا',
                    icon: 'error',
                    confirmButtonText: "<a href='{{ route('login') }}' style='color:#fff;'>موافق</a>"
                })
            });
        </script>
    @else
        @if (is_null(\Auth::user()->phone_verified_at))
            <script>
                $(".clickMy1").click(function() {
                    Swal.fire({
                        title: 'تنبيه',
                        text: 'الرجاء تفعيل الحساب الخاص بك اولا',
                        icon: 'error',
                        confirmButtonText: 'موافق'
                    })
                });
            </script>
        @endif
    @endif
@endpush
