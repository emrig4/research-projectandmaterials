@extends('public.layout')

@section('title', clean(trans('cynoebook::404.not_found')))

@section('content')
    <div class="content">
        <div class="page-404">
            <div class="container">
                <div class="wrapper-404">
                    <div class="title-404">
                        <p class="signal">Oops, This Page Could Not Be Found!</p>
                        <span class="sub mb-30">
                            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable, maybe you should search below.
                        </span>

                        <!-- search -->
                        <div class="clearfix  mt-50"></div>
                        @include('public.include.search_ebook')
                        
                       
                       <div class="col-md-8">
                            <p class="warning">404</p>
                            <button onclick="window.location.href='{{ route('home') }}'" class="btn btn-green"><span>HOME</span></button>
                            <button onclick="window.location.href='{{ url()->previous() }}'" class="btn btn-green"><span>BACK</span></button>
                       </div>
                       <div class="col-md-4 mt-50">
                            @include('public.include.widgets.top-categories_widget')  
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
