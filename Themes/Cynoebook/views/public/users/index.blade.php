@extends('public.layout')

@section('title')
    {{ clean(trans('user::users.users')) }}
@endsection

@push('styles')
        <style type="text/css">
            .sidebar a {
                color: var(--color__secondary);
            }
        </style>
@endpush

@section('content')
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper"><!--.page-title-content--><h2 class="captions">Users</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active"><a href="#">Users</a></li>
                </ol>
            </div>
        </div>
    </div>

    <section class="section pb-50 ">
        <div class="container">
            <div class="col-md-12 sidebar ">

                <div class="ebook-list-result mt-50 clearfix">
                    <div class="row">
                        @forelse($users as $user)
                            <div class="author-widget widget col-md-4 sd380">
                            <div class="title-widget" style="background-color: none"><a href="{{ route('user.profile.show', $user->username)}}" class="" aria-hidden="true">{{ $user->full_name }}</a></div>
                            <div class="content-widget">
                                <div class="staff-item author-widget-wrapper customize">
                                    <div class="staff-item-wrapper">
                                        <div class="staff-info">
                                            <a href="#" class="staff-avatar">
                                                @if ( ! $user->avatar->exists)
                                                    {{ Theme::image('public/images/default-user-image.png') }}    
                                                @else
                                                    <img class="img-fluid img-responsive" src="{{ $user->avatar->path }}">
                                                @endif
                                            </a>
                                            <a href="#" class="staff-name">{{ $user->full_name }}</a>
                                            <h5 class="staff-job">
                                            ({{ clean(trans('user::users.joined')) }}  {{ is_null($user->created_at) ? '&mdash;' : $user->created_at->diffForHumans() }} )
                                            </h5>
                                            <h5 class="total">
                                            {{ intl_number($user->ebooks_count) }} {{ trans_choice('author::authors.books_found', $user->ebooks_count) }}
                                            
                                            </h5>

                                            <div class="staff-desctiption">
                                                <p>{{ $user->bio }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="staff-socials">
                                         @if ($user->facebook!='')
                                            <a href="{{ $user->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($user->twitter!='')
                                            <a href="{{ $user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($user->google!='')
                                            <a href="{{ $user->google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($user->instagram!='')
                                            <a href="{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($user->linkedin!='')
                                            <a href="{{ $user->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($user->youtube!='')
                                            <a href="{{ $user->youtube }}"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                    <a href="{{ route('user.profile.show', $user->username)}}" style="width:  100%" class="btn btn-primary btn-green" aria-hidden="true">
                                        <span>{{ clean(trans('author::authors.view_details')) }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-md-12 text-center"><h3>{{ clean(trans('user::users.no_users_were_found')) }}</h3>
                            </div>
                        @endforelse
                            
                    </div>
                </div>


                 <div class=" col-md-12 section-padding">
                    @if( ($users->links() ))
                        {{ $users->links('public.include.paginator') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
            
@endsection
