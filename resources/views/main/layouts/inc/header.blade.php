<header id="header" class="header transparent">
    @if (\Auth::check())
        @if (is_null(\Auth::user()->phone_verified_at))
            <div class="alert alert-warning" style="border-radius:0px;">
                @lang('برجاء تفعيل الحساب الخاص بك').
                <a href="{{ route('profile.index') }}">
                     من هنا
                </a>
            </div>
        @endif

        @if (\Auth::user()->suspend == 1)
            <div class="alert alert-danger" style="border-radius:0px;">
                @lang('تم حظر هذا الحساب من قبل الإداره').
            </div>
        @endif
    @endif
    <div class="menu">
        <nav id="menu" class="mega-menu">
            <section class="menu-list-items" style="height:80px !important;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 position-relative">
                            <ul class="menu-logo">
                                <li>
                                    <a href="{{ route('home.index') }}"><img id="logo_img" src="{{ getSettings("logo",asset('/dashboard.svg')) }}" alt="logo"> </a>
                                </li>
                            </ul>
                            <div class="menu-bar">
                                <ul class="menu-links">
                                    <li>
                                        <a href="{{ route('home.index') }}">الرئيسية <i class="fa-indicator"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}"> من نحن <i class="fa-indicator"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faq') }}">الاسئلة الشائعة <i class="fa-indicator"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">تواصل معنا<i class="fa-indicator"></i></a>
                                    </li>
                                    @if (\Auth::check())
                                        <li>
                                            <a href="javascript:void(0)">
                                                {{ \Auth::user()->username }}
                                                <i class="fa fa-angle-down fa-indicator"></i>
                                            </a>
                                            <ul class="drop-down-multilevel">
                                                @if (in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray()))
                                                    <li>
                                                        <a href="{{ route('profile.index') }}">الملف الشخصي</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('profile.orders.index') }}">طلباتي</a>
                                                    </li>
                                                    @php
                                                        $notificationCount = \Auth::user()->notifications()->where("seen",0)->count();
                                                    @endphp
                                                    <li>
                                                        <a href="{{ route('profile.notifications.index') }}">
                                                            الاشعارات
                                                            @if ($notificationCount > 0)
                                                                <span style="background: red;padding: 3px;color: white;border-radius: 7px;position: absolute;left: 10px;">
                                                                    {{ $notificationCount }}
                                                                </span>
                                                            @endif
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('admin.home') }}">لوحة التحكم</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('logout') }}">تسجيل الخروج</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}">تسجيل الدخول<i class="fa-indicator"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </nav>
    </div>
</header>
