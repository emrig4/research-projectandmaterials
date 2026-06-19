@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_ebook')))

@section('content_right')
    
    <div class="container">

        <!-- user uploads -->
        <div class="section teacher-course pt-20 pb-100">
                <div class="container teacher-course-wrapper">
                    <div class="underline">My Uploads</div>
                    <div class="course-table">
                        <div class="outer-container">
                            <div class="inner-container">
                                <div class="table-header">
                                    <table class="edu-table-responsive table-hover">
                                        <thead>
                                        <tr class="heading-table">
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
                                            @forelse ($ebooks as $ebook)
                                                <tr >
                                                    <td class="pb-10">
                                                        @if (! $ebook->book_cover->exists)
                                                            <div class="image-placeholder">
                                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                            </div>
                                                        @else
                                                            <div class="image-holder">
                                                                <img style="height: 100px" src="{{ $ebook->book_cover->path }}">
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
