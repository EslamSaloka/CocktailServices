<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo" href="{{route('admin.home.index')}}">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="header-brand-img icon-logo" alt="logo">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" class="header-brand-img desktop-logo theme-logo" alt="logo">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" class="header-brand-img icon-logo theme-logo" alt="logo">
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                    <li class="nav-item  @if( Str::contains(Route::currentRouteName(), 'home') ) active @endif">
                        <a class="nav-link" href="{{ route('admin.home.index') }}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-dashboard sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">@lang('Home')</span>
                        </a>
                    </li>
                    @canAny(['users.index', 'roles.index', 'customers.index'])
                    @php
                        $open_users = false;
                        if( Request::is(['*users*', '*roles*', '*customers*']) ) {
                            $open_users = true;
                        }
                    @endphp
                    <li class="nav-item @if($open_users) show @endif">
                        <a class="nav-link with-sub" href="javascript:void(0)">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-user sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">@lang('المستخدمين')</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="nav-sub @if($open_users) open @endif" @if($open_users) style="display: block;" @else style="display: none;" @endif>
                            @canAny(['users.index'])
                                <li class="nav-item @if( Request::is('*dashboard/users*') ) active @endif">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-user sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">@lang(' الموظفين')</span>
                                    </a>
                                </li>
                            @endcanAny
                            @canAny(['customers.index'])
                                <li class="nav-item @if( Request::is('*dashboard/customers*') ) active @endif">
                                    <a class="nav-link" href="{{ route('admin.customers.index') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-user sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">@lang('العملاء')</span>
                                    </a>
                                </li>
                            @endcanAny
                            @canAny(['roles.index'])
                                <li class="nav-item @if( Request::is('*dashboard/roles*') ) active @endif">
                                    <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-clipboard sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">@lang('الصلاحيات')</span>
                                    </a>
                                </li>
                            @endcanAny
                        </ul>
                    </li>
                    @endcanAny


                    @canAny(['orders.index'])
                        <li class="nav-item @if( Request::is('*dashboard/orders*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-agenda sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الطلبات')</span>
                                @php
                                    $orderCounr = \App\Models\Order::where('seen',0)->count();
                                @endphp
                                @if($orderCounr != 0)
                                    <span class="badge bg-primary side-badge">
                                    {{ ($orderCounr > 1000) ? "1000 +" : $orderCounr }}
                                </span>
                                @endif
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['notifications.index'])
                        <li class="nav-item @if( Request::is('*dashboard/notifications*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.notifications.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-bell sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الإشعارات')</span>
                            </a>
                        </li>
                    @endcanAny


                    @canAny(['contact-us.index'])
                        <li class="nav-item @if( Request::is('*dashboard/contact-us*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.contact-us.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-email sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('رسائل التواصل')</span>
                                @php
                                    $contactUsCount = \App\Models\Contact::where('seen',0)->count();
                                    @endphp
                                @if($contactUsCount != 0)
                                <span class="badge bg-primary side-badge">
                                    {{ ($contactUsCount > 1000) ? "1000 +" : $contactUsCount }}
                                </span>
                                @endif
                            </a>
                        </li>
                    @endcanAny

                    @php
                        $open_settings = false;
                        if( Request::is(['*settings*', '*contents*','*faqs*']) ) {
                            $open_settings = true;
                        }
                    @endphp
                    @canAny(['settings.index','contents.index','faqs.index'])
                        <li class="nav-item @if($open_settings) show @endif">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-settings sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الإعدادت')</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub @if($open_settings) open @endif" @if($open_settings) style="display: block;" @else style="display: none;" @endif>
                                @canAny('settings.index')
                                    <li class="nav-item @if( Request::is('*dashboard/settings*') ) active @endif">
                                        <a class="nav-link" href="{{ route('admin.settings.index') }}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-settings sidemenu-icon menu-icon "></i>
                                            <span class="sidemenu-label">@lang('الإعدادات العامة')</span>
                                        </a>
                                    </li>
                                @endcanAny
                                @canAny('contents.index')
                                    <li class="nav-item @if( Request::is('*dashboard/contents*') ) active @endif">
                                        <a class="nav-link" href="{{ route('admin.contents.index') }}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-book sidemenu-icon menu-icon"></i>
                                            <span class="sidemenu-label">@lang('من نحن')</span>
                                        </a>
                                    </li>
                                @endcanAny
                                @canAny('contents.index')
                                    <li class="nav-item @if( Request::is('*dashboard/terms*') ) active @endif">
                                        <a class="nav-link" href="{{ route('admin.terms.index') }}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-book sidemenu-icon menu-icon"></i>
                                            <span class="sidemenu-label">@lang('شروط و أحكام')</span>
                                        </a>
                                    </li>
                                @endcanAny
                                @canAny('faqs.index')
                                    <li class="nav-item @if( Request::is('*dashboard/faqs*') ) active @endif">
                                        <a class="nav-link" href="{{ route('admin.faqs.index') }}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-help sidemenu-icon menu-icon"></i>
                                            <span class="sidemenu-label">@lang('الأسئلة الشائعة')</span>
                                        </a>
                                    </li>
                                @endcanAny
                            </ul>
                        </li>
                    @endcanAny

                    @canAny(['employers.index'])
                        <li class="nav-item @if( Request::is('*dashboard/employers*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.employers.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-pie-chart sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('جهات العمل')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['sliders.index'])
                        <li class="nav-item @if( Request::is('*dashboard/sliders*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-gallery sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الصور المتحركة')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['banners.index'])
                        <li class="nav-item @if( Request::is('*dashboard/banners*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.banners.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-video-camera sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الفيديوهات')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['services.index'])
                        <li class="nav-item @if( Request::is('*dashboard/services*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.services.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-layout-grid2 sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الخدمات')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['banks.index'])
                        <li class="nav-item @if( Request::is('*dashboard/banks*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.banks.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-list sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الحسابات البنكية')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['counters.index'])
                        <li class="nav-item @if( Request::is('*dashboard/counters*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.counters.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-bar-chart-alt sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('الإحصائيات')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['partners.index'])
                        <li class="nav-item @if( Request::is('*dashboard/partners*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.partners.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-face-smile sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('شركاء النجاح')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['entitles.index'])
                        <li class="nav-item @if( Request::is('*dashboard/entitles*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.entitles.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-money sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('جهات التمويل')</span>
                            </a>
                        </li>
                    @endcanAny

                    @canAny(['testimonials.index'])
                        <li class="nav-item @if( Request::is('*dashboard/testimonials*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.testimonials.index') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-medall sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">@lang('أراء العملاء')</span>
                            </a>
                        </li>
                    @endcanAny

                </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
