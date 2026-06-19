@extends("public.layout",['title'=>$post->gen_seo_title()])

@push('meta')
    <meta name="description" content="{{ $post->meta_desc }}"/>
    <meta name="keywords" content="{{ $post->meta_keywords }}"/>
@endpush

@section('blog-custom-css')
    <link type="text/css" href="{{ asset('binshops-blog.css') }}" rel="stylesheet">
@endsection

@section("content")
    <!-- blog header and breadcrum -->
    @include('binshopsblog::sitewide.blog_header', ['title' => 'Articles and Updates'])

    @if(config("binshopsblog.reading_progress_bar"))
        <div id="scrollbar">
            <div id="scrollbar-bg"></div>
        </div>
    @endif


    <div class="section section-padding news-detail">
        <div class="container">
            <div class="news-detail-wrapper">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        @include("binshopsblog::partials.show_errors")
                        @include("binshopsblog::partials.full_post_details")


                        @if(config("binshopsblog.comments.type_of_comments_to_show","built_in") !== 'disabled')
                            <div class="" id='maincommentscontainer'>
                                @include("binshopsblog::partials.show_comments")
                            </div>
                        @else
                            {{--Comments are disabled--}}
                        @endif
                    </div>

                    <div class="col-md-3 sidebar layout-right">
                        <div class="row">

                            <!-- recent posts -->
                            @include('binshopsblog::partials.recent_posts_widget')
                            <div class="clearfix"></div>


                            <!-- categories widget -->
                            @include('binshopsblog::partials.categories_widget')
                            <div class="clearfix"></div>

                            <!-- share widget -->
                            @include('public.include.widgets.share_widget', ['title' => $post->title])
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('blog-custom-js')
    <script src="{{asset('binshops-blog.js')}}"></script>
@endsection