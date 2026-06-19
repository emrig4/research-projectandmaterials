<!-- HEADER-->
<header>
 

    <!-- top bar -->
    <div class="header-topbar">
        <div class="container">
            <div class="topbar-left pull-left">
                <div class="hotline"><a href="#"><i class="topbar-icon fa fa-phone"></i><span>{{ setting('contact_phone1') }}</span></a></div>
            </div>
            <div class="topbar-right pull-right">
                <div class="socials">
                    <!-- <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> -->
                    @if ($socialLinks->isNotEmpty())
                        @foreach ($socialLinks as $icon => $link)
                            @if (! is_null($link))
                                <a href="{{ $link }}" class="{{ $icon }}"><i class="fa fa-{{ $icon }}" ></i></a>
                            @endif
                        @endforeach
                    @endif

                </div>

                <a href="https://play.google.com/store/apps/details?id=com.webvwapp.projectandmaterials">
                    <img style="height: 40px" src="{{v(Theme::url('public/images/google_badge.png'))}}">
                </a>
                @auth
                    <a href="{{ route('user.profile.show',auth()->user()->username) }}">{{ clean(trans('cynoebook::layout.hello')) }}, {{ auth()->user()->first_name }}!</a>
                @else
                    <div class="group-sign-in">
                        <a href="{{ route('login') }}" class="login">{{ clean(trans('user::auth.sign_in')) }}</a>
                        @if(setting('enable_registrations'))
                         <a href="{{ route('register') }}" class="register">{{ clean(trans('user::auth.sign_up')) }}</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <div class="header-main homepage-01">
        <div class="container">
            <div class="header-main-wrapper">
                <div class="navbar-heade">
                    <div class="logo pull-left">
                        <!-- <a href="index-2.html" class="header-logo"><img src="assets/images/logo-color-1.png" alt="" /></a> -->

                        <a href="{{ route('home') }}" class="header-logo">
                            @if (is_null($headerLogo))
                                <h2>{{ setting('site_name') }}</h2>
                            @else
                                <img src="{{ $headerLogo }}" alt="{{ setting('site_name') }}">
                            @endif
                        </a>
                    </div>
                    <button type="button" data-toggle="collapse" data-target=".navigation" class="navbar-toggle edugate-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>

                @if ($categoryMenu->menus()->isNotEmpty() || $primaryMenu->menus()->isNotEmpty())
                    <nav class="navigation collapse navbar-collapse pull-right">
                        @include('public.include.category_menu')
                        @include('public.include.primary_menu')
                    </nav>
                @endif
            </div>
        </div>

        <div class="col-xs-12 "  style="position: fixed">
            <div class= "search-area  pull-right"> 
                    @include('public.include.search_box3')
            </div>
        </div>
        
    </div>
</header>
