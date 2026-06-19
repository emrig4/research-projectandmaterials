@extends('public.layout')

@section('title', $ebook->name)

@push('meta')
    <meta name="title" content="{{ $ebook->meta->meta_title }}">
    <meta name="keywords" content="{{ implode(',', $ebook->meta->meta_keywords) }}">
    <meta name="description" content="{{ $ebook->meta->meta_description }}">
    <meta property="image" content="{{ $ebook->bookCover->path }}">
    <meta property="og:title" content="{{ $ebook->meta->meta_title }}">
    <meta property="og:description" content="{{ $ebook->meta->meta_description }}">
    <meta property="og:image" content="{{ $ebook->bookCover->path }}">
@endpush

@section('content')
    
    <!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    Book Details
                </h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">{{ $ebook->title }}</li>
                </ol>
            </div>
        </div>
    </div>


    @if (setting('cynoebook_ad1_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
    @endif 
    <div class="section section-padding courses-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="course-title">{{ $ebook->title }}</h2>
                    
                    <div class="course-info info">
                        <div class="author item"><a href="#">
                            @if($ebook->user()->exists())
                                <a href="{{ route('user.profile.show',$ebook->user->username) }}">
                                    <!-- <span>Uploaded By&nbsp;</span><span> {{ $ebook->user->full_name }} </span></a> -->
                                </a>
                            @else
                                <!-- <span>By&nbsp;</span><span> {{ clean(trans('cynoebook::ebook_card.guest')) }}</span></a> -->
                               
                            @endif
                        </div>
                        @foreach ($ebook->categories as $category)
                            <div class="date-time item">
                                <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                                    {{ $category->name }}{{ (!$loop->last) ? ', ' : ''}}
                                </a>
                            </div>
                        @endforeach
                        <div class="date-time item">
                            <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                                {{ $ebook->created_at->diffForHumans() }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-9  sidebar layout-left">
                    <!-- resource details table -->
                    <div class="table-body" style="height: auto;">
                        <table class="edu-table-responsive table table-responsive table-hover">
                            <tbody>
                            <tr class="heading-content">
                                <td colspan="2" class="left heading-content">Resource Details</td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 fa fa-caret-right"></i>
                                    <span>Price</span></a></td>
                                <td class="">
                                    @if( $ebook->price )
                                        <p>{{ $ebook->currencyCode() }} {{ $ebook->price }}</p>
                                    @else
                                        <p> Free</p>
                                    @endif
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 fa fa-caret-right"></i>
                                    <span>Rating</span></a></td>
                                <td class="">
                                    @if (setting('reviews_enabled'))
                                        @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
                                    @endif
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 fa fa-caret-right"></i>
                                    <span>Views</span></a>
                                </td>
                                <td class="">
                                    {{ $ebook->viewed}}
                                </td>
                            </tr>
                            
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 fa fa-caret-right"></i>
                                    <span>Number of pages</span></a>
                                </td>
                                <td class="">
                                    {{ $ebook->page_counts}}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 fa fa-caret-right"></i>
                                    <span>Authors</span></a>
                                </td>
                                <td class="">
                                    @foreach ($ebook->authors as $author)
                                        @if($author->is_verified && $author->is_active )
                                            <a href="{{ route('authors.show', $author->slug)}}">{{ $author->name }}</a>{{ (!$loop->last) ? ', ' : ''}}
                                        @else
                                            {{ $author->name }}{{ (!$loop->last) ? ', ' : ''}}
                                        @endif
                                        
                                    @endforeach
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>

                    <div class="table-header">
                        <table class="">
                            <thead>
                            <tr class="heading-table mb-50 " style="display: block;">
                                <th class="right">
                                    @if (setting('enable_ebook_download'))
                                        @if($ebook->file_type=='upload' )
                                            <a class="" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
                                                <button class="btn btn-green">
                                                    <i class="fa fa-download" aria-hidden="true" ></i>
                                                    <span> preview</span>
                                                </button>
                                            </a>
                                        @endif
                                        @if( $ebook->file_type=='external_link')
                                            <a class="" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"> 
                                                <button class="btn btn-green">
                                                    <i class="fa fa-download" aria-hidden="true" ></i>
                                                    <span> preview</span>
                                                </button>
                                            </a>
                                        @endif
                                    @endif

                                    
                                </th> 
                                <th class="" style="padding-left: 5px"> 
                                    <!-- proceed to cart -->
                                    <a href="{{route('ebooks.cart', ['ebook' => $ebook->id])}}" class="btn btn-green"><span>Full Chapters</span></a>

                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>

                <div class="col-md-3  layout-right">
                    @if(auth()->user())
                        @if ($ebook->user_id==auth()->user()->id)
                            <a href="{{ route('admin.ebooks.edit', ['id' => $ebook->id]) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                                <span><i class="fa fa-pencil" aria-hidden="true"></i></span>
                            </a>
                                
                            <a href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" class="btn btn-green btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')">
                                <span><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                            </a>
                        @endif
                    @endif
                     @include('public.ebooks.partials.ebook.images')
                    <!-- include('public.ebooks.partials.ebook.details') -->
                </div>
            </div>

            <div class="">
                <div class="col-md-9">
                   <!-- reviews -->
                    <div class="tab ebook-tab clearfix">
                        <ul class="nav nav-tabs">
                            <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? '' : 'active' }}">
                                <a data-toggle="tab" href="#description">{{ clean(trans('cynoebook::ebook.tabs.description')) }}</a>
                            </li>

                            <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? 'active' : '' }} {{ review_form_has_error($errors) ? 'error' : '' }}">
                                    <a data-toggle="tab" href="#downloads">
                                        Download
                                    </a>
                            </li>
                            
                            @if (setting('reviews_enabled'))
                                <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? 'active' : '' }} {{ review_form_has_error($errors) ? 'error' : '' }}">
                                    <a data-toggle="tab" href="#reviews">{{ clean(trans('cynoebook::ebook.tabs.reviews')) }}</a>
                                </li>
                            @endif
                            
                        </ul>

                        <div class="tab-content">
                            @include('public.ebooks.partials.ebook.tab_contents.description')

                            @include('public.ebooks.partials.ebook.tab_contents.downloads')

                            @includeWhen(setting('reviews_enabled'), 'public.ebooks.partials.ebook.tab_contents.reviews')
                              
                        </div>
                    </div>
                   

                  <div class="line-divider1" style="padding: 5px 0;"></div>
                    <!-- reader -->
                    <div class="mt-50">
                        @if(setting('member_only_reading_books'))
                            @if(auth()->user())
                                @include('public.ebooks.partials.ebook.view-files')
                            @else
                                <div class="form-group text-center" style="border: 1px solid;padding: 15px;">
                                    <h3>{{ clean(trans('cynoebook::ebook.for_read_a_book_please_sign_into_your_account')) }}</h3>
                                    <a class="btn btn-primary btn-lg" data-loading href="{{ route('login') }}">{{ clean(trans('cynoebook::ebook.login')) }}</a>
                                </div>
                            @endif
                        @else
                            @include('public.ebooks.partials.ebook.view-files')
                        @endif
                    </div>

                    <!-- ads and related books -->
                    <div class="">
                        @if (setting('cynoebook_ad2_section_enabled'))
                            @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_2')])
                        @endif 
                                
                           <!--  include('public.ebooks.partials.ebook_carousel', [
                                'title' => clean(trans('cynoebook::ebook.related_ebooks')),
                                'ebooks' => $relatedEbooks
                            ]) -->
                                
                        @if (setting('cynoebook_ad3_section_enabled'))
                            @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_3')])
                        @endif 
                    </div>

                    <!-- quick links mobile -->
                    <div class="visible-xs">
                        @include('public.include.quicklinks') 
                    </div>
                     

                </div>

                <div class="col-md-3 sidebar layout-right">
                    <div class="col-md-12">
                        @if($categories->isNotEmpty() )
                            @include('public.include.widgets.top-categories_widget')
                        @endif
                    </div>

                    <div class="col-md-12">
                        <!-- this will be changed to tags -->
                        @if($categories->isNotEmpty() )
                            @include('public.include.widgets.ebook_tags_widget')
                        @endif
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <!-- quick links desktop -->
            <div class="hidden-xs">
                @include('public.include.quicklinks')  
            </div>
        </div>
    </div>
    
@endsection
