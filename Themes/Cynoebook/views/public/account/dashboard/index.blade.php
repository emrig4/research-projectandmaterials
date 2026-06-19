@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_ebook')))

@section('content_right')
    
    <div class="container">

        <!-- user uploaded ebooks ///hidden -->
        <div class="hidden col-md-12">
            <div class="row">
                <div class="index-table">
                    @if ($ebooks->isEmpty())
                        <h3 class="text-center">{{ clean(trans('cynoebook::account.ebooks.no_ebooks')) }}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.book_cover')) }}</th>
                                        <th width="200px">{{ clean(trans('cynoebook::account.ebooks.ebook')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.featured')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.private')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.views')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.status')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.date')) }}</th>
                                        <th>{{ clean(trans('cynoebook::account.ebooks.action')) }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($ebooks as $ebook)
                                        <tr>
                                            <td>
                                                @if (! $ebook->book_cover->exists)
                                                    <div class="image-placeholder">
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    </div>
                                                @else
                                                    <div class="image-holder">
                                                        <img src="{{ $ebook->book_cover->path }}">
                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                @if($ebook->is_active==1)
                                                    <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">{{ $ebook->title }}</a>
                                                @else
                                                    {{$ebook->title}}
                                                @endif
                                            </td>

                                            <td>
                                                @if($ebook->is_featured==1)
                                                    {{ clean(trans('cynoebook::account.ebooks.yes')) }}
                                                @else
                                                    {{ clean(trans('cynoebook::account.ebooks.no')) }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if($ebook->is_private==1)
                                                    {{ clean(trans('cynoebook::account.ebooks.yes')) }}
                                                @else
                                                    {{ clean(trans('cynoebook::account.ebooks.no')) }}
                                                @endif
                                            </td>

                                            <td>{{ $ebook->viewed }}</td>
                                            
                                            <td>
                                                @if($ebook->is_active==1)
                                                    <span class="dot green"></span>
                                                @else
                                                    <span class="dot red"></span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ $ebook->created_at->toFormattedDateString() }}</td>
                                            <td class="action">
                                                <a class="" href="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')" href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>


        <!-- user purchases -->
        <div class="section teacher-course pt-20 pb-100">
                <div class="container teacher-course-wrapper">
                    <div class="underline">My Purchases</div>
                    <div class="course-table">
                        <div class="outer-container">
                            <div class="inner-container">
                                <div class="table-header">
                                    <table class="edu-table-responsive">
                                        <thead>
                                        <tr class="heading-table">
                                            <th class="">S/N</th>
                                            <th class="">Title</th>
                                            <th class="">Price</th>
                                            <th class="">Date</th>
                                            <th class="">Count</th>
                                            <th class="">Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="table-body">
                                    <table class="edu-table-responsive table-hover">
                                        <tbody>
                                        @forelse ($customerPurchases as $purchase)
                                            @if($purchase->ebook)
                                                <tr class="table-row">
                                                    <td class="">
                                                        <span>{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td class="">
                                                        <a href="{{ route('ebooks.show', ['slug' => $purchase->ebook->slug]) }}">{{ $purchase->ebook->title }}</a>
                                                    </td>
                                                    <td class="">
                                                        <a href="">{{ $purchase->ebook->price }}</a>
                                                    </td>
                                                    <td class="">
                                                        <span>{{ $purchase->created_at->format('d-m-Y') }}</span>
                                                    </td>
                                                    <td class="">
                                                        <span>{{ $purchase->download_count }}</span>
                                                    </td>

                                                    <td class="">
                                                        @if($purchase->ebook->main_file_type=='upload' )
                                                            <a class="btn btn-green  mb-3" href="{{ route('ebooks.purchased.download',[$purchase->ebook->slug ,id_encode($purchase->ebook->main_book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.full-download')) }}"><span><i class="fa fa-download" aria-hidden="true" style="color: white" ></i></span></a>
                                                        @endif
                                                        @if( $purchase->ebook->main_file_type=='external_link')
                                                            <a class="btn btn-green   mb-3 " href="{{ route('ebooks.purchased.download',$purchase->ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><span><i class="fa fa-download" aria-hidden="true" style="color: white" ></i></span></a>
                                                        @endif

                                                        <a href="{{ route('ebooks.show', ['slug' => $purchase->ebook->slug]) }}" title="View details" style="background: white"  class="btn btn-default mt-4 btn-primary btn-sm"><i class="fa fa-eye text-white"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                            <h3 class="text-center">{{ "You haven't purchased a Resouce yet." }}</h3>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
    @if ($ebooks->isNotEmpty())
        <div class="pull-right">
            {!! $ebooks->links() !!}
        </div>
    @endif
@endsection
