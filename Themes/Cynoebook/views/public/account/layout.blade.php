@extends('public.layout')

@push('styles')
   <style type="text/css">
       .list-inline > li {
            display: inline-block;
            padding-right: 5px;
            padding-left: 5px;
            padding: 10px;
            border-radius: 5px;
        }

        .usermenu .list-inline > li {
            background: #fafafa;
        }
   </style>
@endpush

@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
        <li  class="bg-white"><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_account')) }}</a></li>
        <li class="bg-white active">{{ clean(trans('cynoebook::account.links.my_ebook')) }}</li>
        
    @else
        <li class="bg-white"><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_account')) }}</a></li>
    @endif

    @yield('account_breadcrumb')
@endsection

@section('content')
    @if (setting('cynoebook_ad1_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
    @endif 
        <div class="container">
            <!-- <div class="clearfix"></div> -->

            <div class="">
                <ul class="list-inline">
                    <li class="bg-white {{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                        <a href="{{ route('account.dashboard.index') }}">
                            <i class="mx-5 fa fa-shopping-cart" aria-hidden="true"></i>
                            {{ 'My Orders' }}
                        </a>
                    </li>
                    <li class="bg-white {{ request()->routeIs('account.dashboard.uploads') ? 'active' : '' }}">
                        <a href="{{ route('account.dashboard.uploads') }}">
                            <i class="mx-5  fa fa-book" aria-hidden="true"></i>
                            {{ 'My Uploads'}}
                        </a>
                    </li>
                    @if(setting('enable_ebook_upload'))
                    <li class="bg-white {{ request()->routeIs('ebooks.upload') ? 'active' : '' }}">
                        <a href="{{ route('ebooks.upload') }}">
                            <i class="mx-5 fa fa-upload" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.upload_ebook')) }}
                        </a>
                    </li>
                    <li class="bg-white {{ ( request()->routeIs('account.authors.index' ) || request()->routeIs('account.authors.create' ) || request()->routeIs('account.authors.edit' )  ) ? 'active' : '' }}">
                        <a href="{{ route('account.authors.index') }}">
                            <i class="mx-5 fa fa-address-book" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.my_authors')) }}
                        </a>
                    </li>
                    @endif
                    
                    <li class="bg-white {{ request()->routeIs('account.favorite.index') ? 'active' : '' }}">
                        <a href="{{ route('account.favorite.index') }}">
                            <i class="mx-5 fa fa-heart" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.my_favorite')) }}
                        </a>
                    </li>

                    <!-- airon hidden -->
                    <li class="hidden bg-white  {{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                        <a href="{{ route('account.reviews.index') }}">
                            <i class="mx-5 fa fa-comment" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.my_reviews')) }}
                        </a>
                    </li>

                    <!-- airon hidden -->
                    <li class="hidden bg-white {{ request()->routeIs('user.profile.show') ? 'active' : '' }}">
                        <a target="_blank" href="{{ route('user.profile.show',auth()->user()->username) }}">
                            <i class="mx-5 fa fa-user" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.my_profile')) }}
                        </a>
                    </li>
                    
                    <li class=" bg-white {{ request()->routeIs('account.profile.edit') ? 'active' : '' }}">
                        <a href="{{ route('account.profile.edit') }}">
                            <i class="mx-5 fa fa-pencil-square-o" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.edit_profile')) }}
                        </a>
                    </li>
                    
                    <li class="bg-white">
                        <a href="{{ route('logout') }}">
                            <i class="mx-5 fa fa-sign-out" aria-hidden="true"></i>
                            {{ clean(trans('cynoebook::account.links.logout')) }}
                        </a>
                    </li>
                </ul>
                <hr/>
            </div>
        
            <div class="">
                @yield('content_right')
            </div>
        </div>
            
    @if (setting('cynoebook_ad2_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_2')])
    @endif
@endsection
