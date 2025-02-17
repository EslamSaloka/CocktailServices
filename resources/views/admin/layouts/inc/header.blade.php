<div class="main-header side-header sticky">
    <div class="main-container container-fluid">
        <div class="main-header-left mmenu">
            <a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
            <div class="hor-logo">
                <a class="main-logo" href="{{route('admin.home.index')}}">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="header-brand-img desktop-logo-dark"
                        alt="logo">
                </a>
            </div>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="{{route('admin.home.index')}}"><img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="mobile-logo" alt="logo"></a>
                <a href="{{route('admin.home.index')}}"><img src="{{ getSettings("logo",asset('/dashboard.svg')) }}" height="45px;" class="mobile-logo-dark"
                        alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
            <div
                class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <div class="d-flex order-lg-2 ms-auto">
                        <!-- Theme-Layout -->
                        <div class="dropdown d-flex main-header-theme">
                            <a class="nav-link icon layout-setting">
                                <span class="dark-layout">
                                    <i class="fe fe-sun header-icons"></i>
                                </span>
                                <span class="light-layout">
                                    <i class="fe fe-moon header-icons"></i>
                                </span>
                            </a>
                        </div>
                        <!-- Theme-Layout -->
                        <!-- Full screen -->
                        <div class="dropdown ">
                            <a class="nav-link icon full-screen-link">
                                <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                                <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                            </a>
                        </div>
                        <!-- Full screen -->
                        <!-- Profile -->
                        <div class="dropdown main-profile-menu">
                            <a class="d-flex" href="javascript:void(0)">
                                <span class="main-img-user">
                                    <img
                                        alt="avatar"
                                        src="{{ (new \App\Support\Image)->displayImageByModel(\Auth::user(),"avatar") }}">
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <h6 class="main-notification-title">{{ Auth::user()->username }}</h6>
                                    <p class="main-notification-text">
                                        @foreach (\Auth::user()->roles()->get() as $role)
                                            {{ __($role->name) }},
                                        @endforeach
                                    </p>
                                </div>
                                <a class="dropdown-item border-top" href="{{ route('admin.profile.index') }}">
                                    <i class="fe fe-user"></i> @lang('الحساب الشخصي')
                                </a>
                                <a class="dropdown-item border-top" href="{{ route('admin.change_password.index') }}">
                                    <i class="fe fe-lock"></i> @lang('تغيير كلمة المرور')
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="fe fe-power"></i> @lang('تسجيل خروج')
                                </a>
                            </div>
                        </div>
                        <!-- Profile -->
                        <!-- Sidebar -->
                        {{-- <div class="dropdown  header-settings">
                            <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="sidebar-right"
                                data-bs-target=".sidebar-right">
                                <i class="fe fe-align-right header-icons"></i>
                            </a>
                        </div> --}}
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
