
<!DOCTYPE html>
<html lang="ar">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5, user-scalable=no">

    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>كوكتيل - {{ $order->id_hash }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/pdf/style-pdf.css') }}">
</head>

<body>
<div class="tm_container">
    <div class="tm_invoice_wrap">

        <div class="tm_invoice tm_style2 tm_type1 tm_accent_border tm_radius_0 tm_small_border" id="tm_download_section" >
            <div class="tm_invoice_in">
                <div class="tm_invoice_head tm_mb20 tm_m0_md">
                    <div class="tm_invoice_left">
                        <div class="tm_logo"><img src="{{ url(getSettings("logo",asset('/dashboard.svg'))) }}" alt="Logo"></div>
                    </div>
                    <div class="tm_invoice_right">
                        <div class="tm_grid_row tm_col_3">
                            <div class="" style="float:right;text-align:right;margin-right:30px;">
                                <p class="tm_primary_color tm_mb0">المملكة العربية السعودية</p>
                                <p class="tm_primary_color tm_mb0">مؤسسة كوكتيل خدمات للتسويق الالكتروني</p>
                                <p class="tm_primary_color tm_mb0">سجل تجاري : {{ getSettings('commercial_registration') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tm_shape_bg tm_accent_bg_10 tm_border tm_accent_border_20"></div>
                </div>
                <div class="tm_table tm_style1">
                    <div class="tm_border tm_accent_border_20">
                        <div class="tm_table_responsive">
                            <table style="direction:rtl;">

                                <thead>
                                <tr style="text-align:center;">
                                    <td class="tm_semi_bold" colspan="4" style="font-size:18px;">معلومات مقدم الطلب</td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">الاسم</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">رقم الهوية</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">رقم الجوال</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">المنطقة</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->username }}</td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->id_number }}</td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->phone }}</td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->area }}</td>
                                </tr>
                                <tr style="text-align:center;">
                                    <td class="tm_semi_bold" colspan="4" style="font-size:18px;">معلومات جهة العمل والراتب الفعلي</td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">نوع العمل</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">جهة العمل</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">عدد سنوات العمل</th>
                                    <th style="text-align:center;" class="tm_semi_bold tm_accent_color tm_accent_bg_10">مقدار الراتب</th>
                                </tr>
                                <tr>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->employer->name }}</td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->employer_name }}</td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->employer_years }} </td>
                                    <td style="text-align:center;" class="tm_accent_border_20">{{ $order->user->salary }} ريال</td>
                                </tr>
                                <tr style="text-align:right;">
                                    <td class="tm_semi_bold tm_accent_color tm_accent_bg_10" style="text-align:center;" colspan="2">نوع الطلب</td>
                                    <td style="text-align:center;" class="tm_semi_bold" colspan="2">{{ $order->service->name }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="margin-top:30px;">
                        <div class="tm_left_footer" style="text-align:center;">
                            <p class="tm_mb2" style="text-align:center;font-size:20px;"><b class="tm_primary_color">السادة جهة التمويل</b></p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="tm_m0 tm_f18 tm_primary_color tm_mb5" style="text-align:right;direction:rtl;">السلام عليكم ورحمة الله وبركاته :</p>
                    <p class="tm_m0 tm_f18 tm_primary_color tm_mb5" style="text-align:right;direction:rtl;">الرجاء التواصل مع عميل منصة كوكتيل خدمات لإستكمال الإجراءات من قبلكم وإشعارنا بأنه تم التواصل عبر الواتس أب</p>
                    <p class="tm_m0 tm_f18 tm_primary_color tm_mb5" style="text-align:right;direction:rtl;"> رقم : {{ getSettings('whatsapp') }} الخاص بنا.</p>
                    <p class="tm_m0 tm_f18 tm_primary_color tm_mb5" style="text-align:center;direction:rtl;margin-top:10px;">وتقبلوا فائق الاحترام والتقدير</p>
                </div>
            </div>



            <div class="tm_bottom_invoice tm_accent_border_20">

                <div class="tm_bottom_invoice_left" style="margin-top:-50px;">
                    <p class="tm_m0 tm_f18 tm_primary_color tm_mb5">منصة كوكتيل خدمات</p>
                    <p class="tm_primary_color tm_semi_bold" style="margin-left:50px;">(الختم)</p>
                </div>
                <div style="margin-top:30px;">
                    <div class="tm_logo"><img src="{{ url('/pdf/stamp.png') }}" alt="Logo"></div>
                </div>
            </div>


            <div style="margin-top:170px;z-index:100000">
                <p class="tm_f13 tm_primary_color" style="text-align:right;direction:rtl;">
                    العنوان : {{ getSettings("address_name") }}
                </p>
                <p class="tm_f13 tm_primary_color" style="text-align:right;direction:rtl;">
                    رقم الجوال : {{ getSettings('phone') }}
                </p>
                <p class="tm_f13 tm_primary_color" style="text-align:right;direction:rtl;">
                    البربد الالكتروني : {{ getSettings('email') }}
                </p>

            </div>


        </div>




        <div class="tm_invoice_btns tm_hide_print">
            <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
                <span class="tm_btn_text">طباعه</span>
            </a>
            <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
                <span class="tm_btn_text">تنزيل</span>
            </button>
        </div>
    </div>
</div>
<script src="{{ url('/pdf/jquery.min.js') }}"></script>
<script src="{{ url('/pdf/jspdf.min.js') }}"></script>
<script src="{{ url('/pdf/html2canvas.min.js') }}"></script>
<script>

    (function ($) {
        'use strict';

        $('#tm_download_btn').on('click', function () {
            var downloadSection = $('#tm_download_section');
            var cWidth = downloadSection.width();
            var cHeight = downloadSection.height();
            var topLeftMargin = 0;
            var pdfWidth = cWidth + topLeftMargin * 2;
            var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
            var canvasImageWidth = cWidth;
            var canvasImageHeight = cHeight;
            var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;

            html2canvas(downloadSection[0], { allowTaint: true }).then(function (
                canvas
            ) {
                canvas.getContext('2d');
                var imgData = canvas.toDataURL('image/jpeg', 1.0);
                var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
                pdf.addImage(
                    imgData,
                    'PNG',
                    topLeftMargin,
                    topLeftMargin,
                    canvasImageWidth,
                    canvasImageHeight
                );
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(pdfWidth, pdfHeight);
                    pdf.addImage(
                        imgData,
                        'PNG',
                        topLeftMargin,
                        -(pdfHeight * i) + topLeftMargin * 0,
                        canvasImageWidth,
                        canvasImageHeight
                    );
                }
                pdf.save("{{ str_replace(' ','_',$order->user->username) }}.pdf");
                //window.close();
            });
        });

        $('#tm_download_btn').click();

    })(jQuery);
</script>
</body>
</html>
