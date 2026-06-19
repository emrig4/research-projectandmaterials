@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Services')

    <li class="nav-item">services</li>
@endcomponent

@section('content')
    <section class="">
       <div class="col-md-12 pb-50">
            <div class="pull-right"><button class="btn btn-primary" onclick='window.location="{{ route ('admin.services.create') }}"'>CREATE</button></div>
       </div>

        <div class="col-md-12"> <hr></div>
        <div class="pricing-table">
            <div class="row">
                @forelse($services as $service)
                    <div class="col-md-4 mb-20">
                        <div class="pricing-option">
                            <i class="{{ $service->icon_class }}"></i>
                            <h1>{{ $service->title }}</h1>
                            <hr />
                            <p>{{ $service->short_description }}</p>
                            <hr />
                            <div class="price">
                                <div class="front">
                                    <span class="price">{{ $service->currencyCode() }}{{ $service->price }} </span>
                                </div>
                                <div class="back">
                                    <a href="{{ route('admin.services.edit', ['id' => $service->id]) }}" class="button">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>NO Services</h1>
                @endforelse

                 {!! $services->links() !!}
            </div>
        </div>

    </section>
@endsection
