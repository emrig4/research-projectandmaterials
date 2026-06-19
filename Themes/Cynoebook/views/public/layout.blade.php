<!DOCTYPE html>
<html lang="{{ locale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="no-referrer">

        <title>
            @hasSection('title')
                @yield('title') - {{ setting('site_name') }}
            @else
                {{ setting('site_name') }}
            @endif
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('meta')

        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet"> -->

        <!-- LIBRARY FONT-->
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,400italic,700,900,300">
        <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/font/font-icon/font-awesome-4.4.0/css/font-awesome.css')) }}">
        <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/font/font-icon/font-svg/css/Glyphter.css')) }}">



        <!-- LIBRARY CSS-->
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/animate/animate.css')) }}"> -->
        <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/bootstrap-3.3.5/css/bootstrap.css')) }}">
        <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/owl-carousel-2.0/assets/owl.carousel.css')) }}">
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/selectbox/css/jquery.selectbox.css')) }}"> -->
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/fancybox/css/jquery.fancybox.css')) }}"> -->
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/fancybox/css/jquery.fancybox-buttons.css')) }}"> -->
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/fancybox/css/jquery.fancybox-buttons.css')) }}"> -->
        <!-- <link type="text/css" rel="stylesheet" href="{{ v(Theme::url('public/libs/media-element/build/mediaelementplayer.min.css')) }}"> -->

        <!-- main css -->
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/spacing.css')) }}">
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/pricing-table.css')) }}">
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/misc.css')) }}">
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/color-2.css')) }}">
        <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

        <!-- JS -->
        <script src="{{ v(Theme::url('public/libs/jquery/jquery-2.1.4.min.js')) }}"></script>

        

        @stack('styles')

        @if(setting('custom_css')!='')
            <style>
                {!! setting('custom_css') !!}
            </style>
        @endif

        <script>
            window.CynoEBook = {
                csrfToken: '{{ csrf_token() }}',
                langs: {
                    'cynoebook::ebooks.loading': '{{ clean(trans("cynoebook::ebooks.loading")) }}',
                },
            };
        </script>

        @stack('globals')
        
        {!! setting('googleanalyticscode',null,0) !!}
        
        @routes
    </head>

    <body class="{{ $theme }} {{ cynoebook_layout() }} {{ is_rtl() ? 'rtl' : 'ltr' }}">
        <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main" id="app">
            <div class="wrapper">
                <!-- include('public.include.sidebar') -->
                @include('public.include.header')
            
                </header>
                <!-- WRAPPER-->
                <div id="wrapper-content">

                    <!-- PAGE WRAPPER-->
                    <div id="page-wrapper">
                        <!-- MAIN CONTENT-->
                        <div class="main-content">
                            <!-- CONTENT-->
                            <div class="content">
                                @include('public.include.breadcrumb')

                                @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete'))
                                    @include('public.include.notification')
                                @endunless

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>

                @include('public.testimonials.partials.mega_slider')

                <!-- include('public.include.subscribe') -->
                <div class="line-divider1" style="padding: 5px 0;"></div>
                @include('public.include.top-footer')
                @include('public.include.footer')

                <!-- <a class="scroll-top" href="#">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </a> -->
            </div>
            
            <!-- include('public.include.cookie_bar') -->
            <!-- include('public.include.newsletter') -->
            
        </div>

        
       

        <script src="{{ v(Theme::url('public/libs/bootstrap-3.3.5/js/bootstrap.min.js')) }}"></script>
        <!-- <script src="{{ v(Theme::url('public/libs/smooth-scroll/jquery-smoothscroll.js')) }}"></script> -->
        <script src="{{ v(Theme::url('public/libs/owl-carousel-2.0/owl.carousel.min.js')) }}"></script>
        <!-- <script src="{{ v(Theme::url('public/libs/appear/jquery.appear.js')) }}"></script> -->
        <!-- <script src="{{ v(Theme::url('public/libs/count-to/jquery.countTo.js')) }}"></script> -->
        <script src="{{ v(Theme::url('public/libs/wow-js/wow.min.js')) }}"></script>
        <script src="{{ v(Theme::url('public/libs/selectbox/js/jquery.selectbox-0.2.min.js')) }}"></script>
        <!-- <script src="{{ v(Theme::url('public/libs/fancybox/js/jquery.fancybox.js')) }}"></script> -->
        <!-- <script src="{{ v(Theme::url('public/libs/fancybox/js/jquery.fancybox-buttons.js')) }}"></script> -->
        <script src="{{ v(Theme::url('public/js/main.js')) }}"></script>
        <!-- <script src="{{ v(Theme::url('public/libs/isotope/isotope.pkgd.min.js')) }}"></script> -->
        <!-- <script src="{{ v(Theme::url('public/libs/isotope/fit-columns.js')) }}"></script> -->
        <!-- <script src="{{ v(Theme::url('public/js/pages/homepage.js')) }}"></script> -->


       

        @stack('scripts')
        @include('public.include.whatsapp-chat')

        @if(setting('custom_js',null,0)!='')
        <script>
            {!! setting('custom_js',null,0) !!}
        </script>
        @endif

        <!-- LOADING-->
        <!-- <div class="body-2 loading">
            <div class="dots-loader"></div>
        </div> -->

    </body>
</html>
