@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_categories_page') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_categories_page') }}">
@endpush
@section('title')
    @if (request()->has('query'))
        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
    @else
        {{ 'Categories' }}
    @endif
@endsection

@push('styles')
    <style type="text/css">
        .flex-row-container{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .flex-row-container > .flex-row-item {
            flex: 1 1 30%;
            height: 110px;
        }

        @media screen and (max-width: 767px){
            .flex-row-container > .flex-row-item {
                flex: 1 1 100%;
            }
        }

        .flex-row-item {

        }
    </style>
@endpush



@section('content')
    <!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    {{ 'Departments' }}
                </h2>
                <ol class="breadcrumb">
                   
                    <li><a href="/">Home</a></li>
                    <li class="active">{{ 'Departments' }}</li>
                   
                </ol>
            </div>
        </div>
    </div>

    <!-- search -->
    @include('public.include.search_ebook')


    <!-- Depatments listing -->    
    <div class="section section-padding courses">
        <div class="container">
            <div class="courses-wrapper">
                <!-- Departments List-->
                <div class="col-md-12" style="padding: 0;">
                    <div class="category-card sd380">
                        <div class="content-card">
                            <ul class="category-card list-unstyled flex-row-container">
                                @foreach($departments as $department)
                                    <li class="flex-row-item " style="text-transform: uppercase; margin: auto 3px"><a href="{{ route('ebooks.index', ['category' => $department->slug])}}" class="link cat-item"><span class="pull-">{{$department->name}}</span><span class=" pull-right pill">{{$department->count}}</span></a></li>
                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    
@endpush
