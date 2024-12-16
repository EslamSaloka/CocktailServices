
<a href="https://api.whatsapp.com/send/?phone={{ getSettings('whatsapp') }}&text&type=phone_number&app_absent=0" class="float">
    <i style="font-size:30px;" class="fa fa-whatsapp my-float"></i>
</a>


<section id="raind" class="raind" style="height: 50px;">
</section>

<section class="contact-box contact-box-top theme-bg">
    <div class="container">
        <div class="row pt-20 pb-40">
            <div class="col-md-4 sm-mb-30">
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fa fa-map text-white"></i>
                    </div>
                    <div class="contact-info">
                        <h5 class="text-white"> {{ getSettings('address_name') }}   </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 sm-mb-30">
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fa fa-phone text-white"></i>
                    </div>
                    <div class="contact-info">
                        <h5 class="text-white">{{ getSettings('phone') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fa fa-envelope text-white"></i>
                    </div>
                    <div class="contact-info">
                        <h5 class="text-white">{{ getSettings('email') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer page-section-pt black-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-6 sm-mb-30">
                <div class="footer-logo">
                    <img id="logo-footer" class="mb-20" src="{{ getSettings("logo",asset('/dashboard.svg')) }}" alt="">
                    <p class="pb-10" style="direction:rtl;">
                        {{ getSettings("footer") }}
                    </p>
                </div>
                <div class="social-icons color-hover">
                    <ul>
                        <li class="social-twitter"><a href="{{ getSettings("instagram") }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li class="social-twitter"><a href="{{ getSettings("twitter") }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li class="social-twitter"><a href="{{ getSettings("snapchat") }}" target="_blank"><i class="fa fa-snapchat"></i> </a></li>
                        <li class="social-twitter"><a href="{{ getSettings("youtube") }}" target="_blank"><i class="fa fa-youtube"></i> </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 sm-mb-30">
                <div class="footer-useful-link footer-hedding">
                    <h6 class="text-white mb-30 mt-10 text-uppercase">صفحات الموقع</h6>
                    <ul>
                        <li><a href="{{ route('home.index') }}">الرئيسية</a></li>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('faq') }}">الاسئلة الشائعة</a></li>
                        <li><a href="{{ route('contact') }}">تواصل معنا</a></li>
                        <li><a href="{{ route('terms') }}">الشروط والأحكام</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <h6 class="text-white mb-30 mt-10 text-uppercase">تواصل معنا</h6>
                <ul class="addresss-info">
                    <li><i class="fa fa-map-marker"></i> العنوان : {{ getSettings('address_name') }}   </li>
                    <li><i class="fa fa-phone"></i> <a href="tel:0501234567"> <span>{{ getSettings('phone') }}</span> </a> </li>
                    <li><i class="fa fa-envelope-o"></i>{{ getSettings('email') }}</li>
                </ul>
            </div>
        </div>
        <div class="footer-widget mt-20">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mt-15"> &copy; <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="#"> منصة كوكتيل خدمات </a> جميع الحقوق محفوظة </p>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('main.layouts.inc.scripts')
