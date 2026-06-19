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

@section('breadcrumb')
    <li><a href="{{ route('ebooks.index') }}">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</a></li>
    <li class="active">{{ $ebook->title }}</li>
@endsection

@section('content')
    <div class="section section-padding courses-detail">
        <div class="container">
            @include('public.ebooks.partials.ebook.purchased-images')
            @include('public.ebooks.partials.ebook.purchased-details')
        

            <div class="col-md-12 pt-50">
                <div class="tab ebook-tab clearfix">
                    <ul class="nav nav-tabs">
                        
                        <li class="{{ request()->has('reviews') || review_form_has_error($errors) ? '' : 'active' }}">
                            <div class="news-comment-title underline">Previous Request</div>
                        </li>
                        
                        
                        
                    </ul>

                    @foreach($customerPurchases as $purchase)
                        @if($purchase->ebook)
                            <div class="table-body" style="height: auto;">
                                <table class="edu-table-responsive table table-responsive table-hover">
                                    <tbody>
                                    <tr class="heading-content">
                                        <td colspan="2" class="left heading-content">{{ $loop->iteration }} | {{ $purchase->ebook->title }}</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="left col-1"><a href="#">
                                            <i class="bg-green mr25 fa fa-caret-right"></i>
                                            <span>Price</span></a></td>
                                        <td class="">
                                            <p>{{ $purchase->ebook->price }}</p>
                                        </td>
                                    </tr>
                                     <tr class="table-row">
                                        <td class="left col-1"><a href="#">
                                            <i class="bg-green mr25 fa fa-caret-right"></i>
                                            <span>Date</span></a>
                                        </td>
                                        <td class="">
                                            <p>{{ $purchase->created_at->format('d-m-Y') }}</p>
                                        </td>
                                    </tr>
                                   <!--  <tr class="table-row">
                                        <td class="left col-1"><a href="#">
                                            <i class="bg-green mr25 fa fa-caret-right"></i>
                                            <span>Downloads</span></a>
                                        </td>
                                        <td class="">
                                            <p>{{ $purchase->download_count }}</p>
                                        </td>
                                    </tr>
 -->
                                    <tr class="table-row">
                                        <td class="left col-1"><a href="#">
                                            <i class="bg-green mr25 fa fa-caret-right"></i>
                                            <span>Re-Download</span></a>
                                        </td>
                                        <td class="">
                                            @if($ebook->main_file_type=='upload' )
                                                <a class="" href="{{ route('ebooks.purchased.download',[$ebook->slug,id_encode($ebook->main_book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.full-download')) }}"><i class="mr25 fa fa-download" aria-hidden="true" ></i></span><span>Download</a>
                                            @endif
                                            @if( $ebook->main_file_type=='external_link')
                                                <a class="" href="{{ route('ebooks.purchased.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="mr25 fa fa-download" aria-hidden="true" ></i><span>Download</span></a>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

        
    </div>  
@endsection
