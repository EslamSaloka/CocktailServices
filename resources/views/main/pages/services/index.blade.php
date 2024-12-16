@extends('main.layouts.master')
@section('title')
    {{ $service->name }}
@endsection
@section('PageContent')

    <!--=================================page-title-->
    <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('services_page_image','/main/images/bg/02.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-name">
                        <h1>طلب جديد</h1>
                        <p>يمكنك اتمام طلبك من هنا</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================page-title -->


    <!--=================================
     careers-->

    <section class="careers white-bg page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <h2 class="title-effect">طلب خدمة ( {{ $service->name }} )</h2>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" role="alert">
                <p>تكلفة رسوم طلب الخدمة : {{ $service->price }} ريال سعودي فقط لا غير</p>
                <p>يتم دفع رسوم طلب الخدمة عبر تحويل المبلغ على  لحساب مؤسسة كوكتيل خدمات للتسويق الالكتروني وارفاق صورة من الايصال عبر تعبئة النموذج ادناه</p>
            </div>

            <br>
            <div class="row">
                <div class="col-lg-6">
                    @foreach ($banks as $bank)
                        <div class="accordion shadow">
                            <div class="acd-group">
                                <a class="acd-heading" href="#">
                                    الحساب البنكي لمنصة كوكتيل خدمات ( {{ $bank->bank_name }} )
                                </a>
                                <div class="acd-des">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <span class="mb-10"><b>البنك : </b> {{ $bank->bank_name }} </span>
                                            <span class="mb-10"><b>اسم صاحب الحساب : </b> {{ $bank->account_name }} </span>
                                            <span class="mb-10"><b>رقم الحساب : </b> {{ $bank->account_number }} </span>
                                            <span  style="direction:rtl;" class="mb-10"><b>رقم الايبان : </b> {{ $bank->iban }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-6 sm-mt-40">
                    <div class="careers-from">
                        <h4>بيانات  اتمام الطلب</h4>
                        @if (\Auth::check())
                            <form action="{{ route('services.store',$service->id) }}" method="post" enctype="multipart/form-data">
                                @endif

                                <div class="section-field mb-20 mt-20">
                                    <label>البنك الذي قمت بالتحويل علية</label>
                                    <div class="field-widget">
                                        <select style="text-align:right;float:right;" class="form-control" id="bank" name="bank_id">
                                            <option value="0" disabled>
                                                إختر البنك
                                            </option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="section-field mb-20" style=" margin-top: 72px !important; ">
                                    <label>البنك الذي قمت بالتحويل من خلاله</label>
                                    <div class="field-widget">
                                        <input type="text" style="text-align:right;" class="form-control" id="bank_name" placeholder="إسم البنك" name="bank_name" value="{{ old('bank_name') }}">
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <label>اسم الشخص المحول</label>
                                    <div class="field-widget">
                                        <input type="text" style="text-align:right;" class="form-control" id="account_name" placeholder="اسم الشخص المحول" name="account_name" value="{{ old('account_name') }}">
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <label>اسم الشخص المحول نيابة عنه (ان وجد)</label>
                                    <div class="field-widget">
                                        <input type="text" style="text-align:right;" class="form-control" id="person_any" placeholder="اسم الشخص المحول نيابة عنه ان وجد" name="person_any" value="{{ old('person_any') }}">
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <label>تاريخ التحويل</label>
                                    <div class="field-widget">
                                        <input type='text' style="text-align:right;" name="transfer_date" class="form-control datetimepicker" id='datetimepicker4' value="{{ old('transfer_date') }}" />
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <label>مبلغ التحويل</label>
                                    <div class="field-widget">
                                        <input type="number" min="1" value="{{ $service->price }}" style="text-align:right;padding-right:10px;" class="form-control" id="transfer_price" placeholder="{{ $service->price }}" name="transfer_price">
                                    </div>
                                </div>

                                <div class="section-field mb-20">
                                    <label>رقم إيصال التحويل</label>
                                    <div class="field-widget">
                                        <input type="number" min="1" style="text-align:right;padding-right:10px;" class="form-control" id="transfer_number" placeholder="رقم الايصال" name="transfer_number" value="{{ old('transfer_number') }}" />
                                    </div>
                                </div>

                                <div class="mb-20">
                                    <div class="file-input">
                                        <label class="form-label">إرفاق صورة إيصال التحويل</label>
                                        <input type="file" name="transfer_image" class="form-control-file  form-control" id="exampleInputFile">
                                    </div>
                                </div>

                                @if (\Auth::check())
                                    <button type="submit" id="submit" class="button">
                                        @csrf
                                        <span>إرسـال الطلب</span>
                                    </button>

                            </form>

                        @else
                            <button id="submit" class="button clickMy">
                                <span>إرسـال الطلب</span>
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('scripts')
    @if (\Auth::check())
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\Main\Services\StoreNewOrderRequest') !!}
    @else
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(".clickMy").click(function() {
                Swal.fire({
                    title: 'تنبيه',
                    text: 'الرجاء تسجيل الدخول أولا',
                    icon: 'error',
                    confirmButtonText: 'موافق'
                })
            });
        </script>
    @endif

@endpush
