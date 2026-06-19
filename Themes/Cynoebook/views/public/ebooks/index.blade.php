@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_ebooks_page') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_ebooks_page') }}">
@endpush
@section('title')
    @if (request()->has('query'))
        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
    @else
        {{ clean(trans('cynoebook::ebooks.ebooks')) }}
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
                        {{ clean(trans('cynoebook::ebooks.ebooks')) }}
                    @endif
                </h2>
                <ol class="breadcrumb">
                    @if (request()->has('query') || request()->has('category'))
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('ebooks.index') }}">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</a></li>
                        
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
                        <li class="active">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</li>
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
                            <h2 class="center-title">Browse Materials</h2>
                            <h4 class="top-title">
                                We have over 100,000 project materials and resources listed. you can also make a special <b><a href="{{ route('services.index') }}">Request</a></b>
                            </h4>
                        @endif
                    </div>

                    <div class="courses-wrapper">

                        <!-- Tab panes-->
                        <div class="col-md-10">
                            <div class="tab-content book-listings ">

                            	<div class="col-md-12">
							        <div class="col-md-6 pull-right">
							        	<ul class="btn-list-grid list-unstyled text-right">
								            <li class="active">
								                <button class="btn-grid"><i class="fa fa-th-large"></i></button>
								            </li>
								            <li>
								                <button class="btn-list"><i class="fa fa-th-list"></i></button>
								            </li>

								            <li>
								            	<div class="form-group">
						                            <select class="custom-select-black" onchange="location = this.value">
						                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'relevance']) }}" {{ ($sortOption = request()->query('sort')) === 'relevance' ? 'selected' : '' }}>
						                                    {{ clean(trans('cynoebook::ebooks.sort_options.relevance')) }}
						                                </option>

						                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'alphabetic']) }}" {{ ($sortOption = request()->query('sort')) === 'alphabetic' ? 'selected' : '' }}>
						                                    {{ clean(trans('cynoebook::ebooks.sort_options.alphabetic')) }}
						                                </option>

						                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'topRated']) }}" {{ $sortOption === 'topRated' ? 'selected' : '' }}>
						                                    {{ clean(trans('cynoebook::ebooks.sort_options.top_rated')) }}
						                                </option>

						                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ $sortOption === 'latest' ? 'selected' : '' }}>
						                                    {{ clean(trans('cynoebook::ebooks.sort_options.latest')) }}
						                                </option>
						                            </select>
						                        </div>
								            </li>
								        </ul>
								        
								        

							        </div>
							    </div>



                                <div id="all" role="tabpanel" class="tab-pane fade in active">
                                    <div class="style-show style-list row">
                                       @forelse ($ebooks as $ebook)
                                            @include('public.ebooks.partials.ebook_card')
                                        @empty
                                            <h3>{{ clean(trans('cynoebook::ebooks.no_ebooks_were_found')) }}</h3>
                                        @endforelse
                                    </div>
                                </div>
                                
                                 <div class="  col-md-12 section-padding">
                                    @if( ($ebooks->links() ))
				                        {{ $ebooks->links('public.include.paginator') }}
                                    @endif
				                </div>
                            </div>
                        </div>

                        <!-- Sidepane -->
                        <div class="col-md-2 category-sidepane">
                            @include('public.ebooks.partials.sidepane')
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
