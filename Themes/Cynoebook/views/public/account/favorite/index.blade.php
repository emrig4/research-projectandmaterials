@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_favorite')))

@section('account_breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::account.links.my_favorite')) }}</li>
@endsection

@section('content_right')
    <div class="container">
        
        

        <!-- user Favorites -->
        <div class="section teacher-course pt-20 pb-100">
                <div class="container teacher-course-wrapper">
                    <div class="underline">My Favorites</div>
                    <div class="course-table">
                        <div class="outer-container">
                            <div class="inner-container">
                                <div class="table-header">
                                    <table class="edu-table-responsive">
                                        <thead>
                                        <tr class="heading-table">
                                            <th>{{ clean(trans('cynoebook::account.favorite.book_cover')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.favorite.ebook')) }}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="table-body">
                                    <table class="edu-table-responsive table-hover">
                                        <tbody>
                                            @forelse ($ebooks as $ebook)
                                                <tr class="table-row">
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
                                                        <h5>
                                                            <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">
                                                                {{ $ebook->title }}
                                                            </a>
                                                        </h5>
                                                    </td>


                                                    <td>
                                                        <form method="POST" action="{{ route('account.favorite.destroy', $ebook) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}

                                                            <button type="submit" class="cross-button remove-ebook" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.favorite.remove')) }}">
                                                                <i class="fa fa-times" aria-hidden="true" data-ebook-id="{{ $ebook->id }}"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <h3 class="text-center">{{ "You haven't liked any book" }}</h3>
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
