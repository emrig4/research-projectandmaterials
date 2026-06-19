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

                <!-- intro -->
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-9 col-sm-12">
                        <div class="row" style="padding: 30px">
                            <div class="col-md-7">
                                
                                <div class="group-title-index"  style="margin-bottom: 10px">
                                    <h2 class="center-title">ABOUT US</h2>
                                    <div class="bottom-title"><i class="bottom-icon icon-a-1-01-01"></i></div>
                                </div>

                                <p style="font-size: 16px; line-height: 30px" class="text-justify">Writing final year Project topic is one of the last opportunity that can enhance or boost your CGPA, most students do not have the skills to complete their final year project,thesis or dissertations which has become a nightmare and also an extra work to their supervisor. Just Imagine you having A or B grade in your project report. That’s why we got you covered. Projectandmaterials reduce the burden by assisting and providing free and relevant resources and materials. It has been observed that student who uses our services and resources always perform well with no stress as our aim is to provide reference tools use for a quick and more comprehensive understanding of your research work which includes Project Topics, Thesis, Dissertations, Seminal Topics, Assignments, Term Papers, Journals and other academic resources/related materials for Guild line and reference purpose.</p>
                            </div>
                            <div class="col-md-5">
                                <img class="" style="height: 300px" src="{{ v(Theme::url('public/images/about1.png')) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- services -->
                <div class="row">
                    @include('public.services.partials.featured')
                </div>

                <!-- how we do it -->
                <div class="row" style="padding: 10px 10%">
                    <div class="group-title-index" style="margin-bottom: 10px">4 Easy Steps</h4>

                        <h2 class="center-title">HOW IT WORKS</h2>

                        <div class="bottom-title"><i class="bottom-icon icon-a-1-01-01"></i></div>
                    </div>
                    @include('public.include.easysteps')

                </div>

                


            </div>
        </div>
    </div>

@endsection

@section('blog-custom-js')
    <script src="{{asset('binshops-blog.js')}}"></script>
@endsection