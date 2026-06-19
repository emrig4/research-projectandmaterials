@extends("public.layout",['title'=> 'Privacy'])

@push('meta')
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
@endpush

@section('blog-custom-css')
    <link type="text/css" href="{{ asset('binshops-blog.css') }}" rel="stylesheet">
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{v(Theme::url('public/css/timeline.css'))}}">
    <style type="text/css">
        
       
    </style>
@endpush

@section("content")
    <!-- blog header and breadcrum -->

    @if(config("binshopsblog.reading_progress_bar"))
        <div id="scrollbar">
            <div id="scrollbar-bg"></div>
        </div>
    @endif


    <div class="section section-padding news-detail">
        <div class="container">
            <div class="news-detail-wrapper">

                

                <!-- how we do it -->
                <div class="row" style="padding: 10px 10%">
                    <div class="group-title-index" style="margin-bottom: 10px">4 Easy Steps</h4>

                        <h2 class="center-title">HOW IT WORKS</h2>

                        <div class="bottom-title"><i class="bottom-icon icon-a-1-01-01"></i></div>
                    </div>
                    @include('public.include.easysteps')

                </div>



                <!-- quick links -->
                <div class="row">
                    @include('public.include.quicklinks')
                </div>

                
            </div>
        </div>
    </div>

@endsection

@section('blog-custom-js')
    <script src="{{asset('binshops-blog.js')}}"></script>
@endsection