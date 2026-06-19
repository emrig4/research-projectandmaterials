@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_categories_page') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_categories_page') }}">
@endpush
@section('title')
    @if (request()->has('query'))
        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
    @else
        {{ 'Categories' }}
    @endif
@endsection




@section('content')
    <!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    @if (request()->has('query'))
                        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
                    @else
                        {{ 'Categories' }}
                    @endif
                </h2>
                <ol class="breadcrumb">
                    @if (request()->has('query') || request()->has('category'))
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('ebooks.index') }}">{{ 'categories' }}</a></li>
                        
                        @if(request()->has('category'))
                            @if(request()->has('query'))
                                <li><a href="{{ route('ebooks.index', ['category' => request('category')]) }}">{{ request('category') }}</a></li>
                            @else
                                <li class="active">{{ request('category') }}</li>
                            @endif
                        @endif
                        
                        @if(request()->has('query'))
                            <li class="active">{{clean(trans('cynoebook::ebooks.search_results_for')) }}:{{ request('query') }}</li>
                        @endif
                        
                        
                    @else
                        <li><a href="/">Home</a></li>
                        <li class="active">{{ 'Categories' }}</li>
                    @endif

                </ol>
            </div>
        </div>
    </div>

    <!-- search -->
    @include('public.include.search_ebook')

    <section class="ebook-list">
        <div class="row">

            <!-- include('public.ebooks.partials.filter') -->
           
            <div class="section section-padding courses">
                <div class="container">
                    <div class="group-title-index">
                        @if(request()->has('category'))
                            @if(request()->has('query'))
                                <li><a href="{{ route('ebooks.index', ['category' => request('category')]) }}">{{ request('category') }}</a></li>
                                <h2 class="center-title">{{ request('category') }}</h2>
                                <span>{{ intl_number($ebooks->total()) }} {{ trans_choice('cynoebook::ebooks.ebooks_found', $ebooks->total()) }}</span>
                            @else
                                <h2 class="center-title">{{ request('category') }}</h2>
                                <span>{{ intl_number($ebooks->total()) }} {{ trans_choice('cynoebook::ebooks.ebooks_found', $ebooks->total()) }}</span>
                            @endif
                        @else
                            <h2 class="center-title">Browse Categories</h2>
                            <div>
                                Showing <strong> {{($categories->currentpage()-1)*$categories->perpage()+1}} to  {{$categories->currentpage()*$categories->perpage()}} </strong> of  <strong> {{$categories->total()}} </strong> entries
                            </div>
                        @endif
                    </div>

                    <div class="courses-wrapper">

                        <!-- Tab panes-->
                        <div class="row">
                            <div class="tab-content book-listings ">
                            	

                               <div class=" pb-20 list-categories-content row">
                                    <div class="customs-row">
                                        @forelse ($categories as $category)
                                            <div class="col-md-4 col-sm-6">
                                                <div class="edugate-layout-3">
                                                    <div class="edugate-layout-3-wrapper">
                                                        <a href="{{ route('ebooks.index', ['category' => $category->slug]) }}" class="edugate-image">
                                                            <img src="{{ $category->getCategoryCover() }}" alt="" class="img-responsive"/>
                                                        </a>

                                                        <div class="edugate-content">
                                                            <a href="{{ route('ebooks.index', ['category' => $category->slug]) }}" class="title">   {{ $category->name }}
                                                            </a>

                                                            <div class="description">{{ $category->description }}</div>
                                                            <div class="total-courses">
                                                                <i class="fa fa-list"></i>
                                                                <a href="{{ route('ebooks.index', ['category' => $category->slug]) }}">total materials {{ $category->totalEbooks() }}</a>
                                                            </div>
                                                            <a href="{{ route('ebooks.index', ['category' => $category->slug]) }}" class="btn btn-green"><span>all materials</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <h3>No Categories found</h3>
                                        @endforelse

                                    </div>
                                </div>

                                <div class="  col-md-12">
				                    {{ $categories->links('public.include.paginator') }}
				                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection


@push('scripts')
    <script src="{{Theme::url('public/js/pages/courses.js')}}"></script>
     <script type="text/javascript">
            $("document").ready(function(){

                $("#category-wrapper").css({
                    'max-height': (window.screen.availHeight) + 'px',
                    'overflow-x': 'auto'
                });
                    
                
            // alert(window.screen.availWidth);
            // alert(window.screen.availHeight);
            })

        </script>
@endpush
