@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_authors') }}"/>
@endpush
@section('title')
    {{ clean(trans('author::authors.authors')) }}
@endsection


@section('content')
        
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper"><!--.page-title-content--><h2 class="captions">Authors</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active"><a href="#">Authors</a></li>
                </ol>
            </div>
        </div>
    </div>

    <section class="section pb-50 ">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <div class="ebook-list-header clearfix">
                    <div class="authors-result-title pull-left my-10">
                        <span>{{ intl_number($authors->total()) }} {{ trans_choice('author::authors.authors_found', $authors->total()) }}</span>
                    </div>

                    <div class="authors-result-right pull-right">
                        <div class="form-group">
                            <select class="custom-select-black" onchange="location = this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'latest' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.latest')) }}
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'oldest' ? 'selected' : '' }}>
                                    {{ clean(trans('author::authors.oldest')) }}
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'alphabetic','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'alphabetic' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.alphabetic')) }}
                                </option>

                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="ebook-list-result m-t-10 clearfix">
                    <div class="row">
                        @forelse($authors as $author)
                            <div class="col-md-4 ">
                                <div class="our-author" style="text-align: center;">
                                    <div class="picture">
                                        @if ( ! $author->author_image->exists)
                                            {{ Theme::image('public/images/default-user-image.png') }}    
                                       
                                        @else
                                            <img style="width: 100%; border-radius: 5%" class="img-fluid" src="{{ $author->author_image->path }}">
                                        @endif
                                    </div>
                                    <div class="author-content">
                                        <h4 class="name">
                                            <a href="{{ route('authors.show', $author->slug)}}" class="" aria-hidden="true">{{ $author->name }}</a>

                                            <span class="total">  {{ intl_number($author->ebooks_count) }} {{ trans_choice('author::authors.books_found', $author->ebooks_count) }}</span>
                                        </h4>
                                    </div>
                                    <ul style="list-style-type: none;">
                                        <li>
                                            <a class="btn btn-green"  href="{{ route('authors.show', $author->slug)}}"aria-hidden="true">
                                                <span>  {{ clean(trans('author::authors.view_details')) }}</span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center"><h3>{{ clean(trans('author::authors.no_authors_were_found')) }}</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="  col-md-12 section-padding">
                @if( ($authors->links() ))
                    {{ $authors->links('public.include.paginator') }}
                @endif
            </div>
        </div>
        
    </section>
@endsection
