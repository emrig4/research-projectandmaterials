@extends("public.layout",['title'=>$title])
@push('meta')
    <meta name="description" content="{{ setting('meta_description_blog') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_blog') }}">
@endpush
@push('styles')
    <link type="text/css" href="{{ asset('binshops-blog.css') }}" rel="stylesheet">
    <style type="text/css">
        .edugate-layout-2 .edugate-content .btn {
             position: relative; 
            left: 50%;
            margin-left: -65px;
            bottom: -50px;
        }
    </style>
@endpush

@section("content")
     @include('binshopsblog::sitewide.blog_header', ['title' => 'Articles and Updates'])
    <div class="binshopsblog_container section section-padding news-page">
        <div class="container">
            <div class="row">

                <div class="col-md-10">
                    @if($category_chain)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @forelse($category_chain as $cat)
                                        <a href="{{$cat->url()}}">
                                            <span class="cat1">{{$cat['category_name']}}</span>
                                        </a>
                                    @empty @endforelse
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($binshopsblog_category) && $binshopsblog_category)
                        <h2 class='text-center'> {{$binshopsblog_category->category_name}}</h2>

                        @if($binshopsblog_category->category_description)
                            <p class='text-center'>{{$binshopsblog_category->category_description}}</p>
                        @endif

                    @endif

                    <div class="container">
                            @forelse($posts as $post)
                                @include("binshopsblog::partials.index_loop_grid")
                            @empty
                                <div class="news-page-wrapper">
                                    <div class='alert alert-danger'>No posts!</div>
                                </div>
                            @endforelse
                    </div>
                </div>

               <!--  <div class="col-md-3">
                    <h6>Blog Categories</h6>
                    <ul class="binshops-cat-hierarchy">
                        @if($categories)
                            @include("binshopsblog::partials._category_partial", ['category_tree' => $categories, 'name_chain' => $nameChain = "" ])
                        @else
                            <span>No Categories</span>
                        @endif
                    </ul>
                </div> -->

                <div class="col-md-2 sidebar layout-right">
                    <div class="row">

                        <!-- recent posts -->
                        @include('binshopsblog::partials.recent_posts_widget')
                        <div class="clearfix"></div>


                        <!-- categories widget -->
                        @include('binshopsblog::partials.categories_widget')
                        <div class="clearfix"></div>

                        <!-- share widget -->
                        @include('public.include.widgets.share_widget')
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="  col-md-12">
                    @if( ($posts->links() ))
                        {{ $posts->links('public.include.paginator') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
      

        @if (config('binshopsblog.search.search_enabled') )
            <!-- include('binshopsblog::sitewide.search_form') -->
        @endif
    </div>

@endsection
