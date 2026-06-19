@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Service Requests')

    <li class="nav-item">requests</li>
@endcomponent

@section('content')
    <section class="">
        <div class="col-md-12 pb-50"> <hr></div>
        <div class="container">
          <h2 class="title mb-20">Service Request</h2>

          <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">S/N</div>
                <div class="col col-2"> Name</div>
                <div class="col col-2"> Email</div>
                <div class="col col-2">Subject</div>
                <div class="col col-2">Status</div>
                <div class="col col-2">Date</div>

            </li>
            @forelse($serviceRequests as $request)
            <li class="table-row" onclick="window.location='{{ route('admin.servicerequests.show', ['id' => $request->id ]) }}'" style="cursor: pointer;">
                <div class="col col-1" data-label="Service Id">{{$loop->iteration}}</div>
                <div class="col col-2" data-label="Customer Name">{{$request->contact_name}}</div>
                <div class="col col-2" data-label="Customer Email">{{$request->contact_email}}</div>
                <div class="col col-2" data-label="Subject">{{$request->subject}}</div>
                <div class="col col-2" data-label="Status">{{$request->status}}</div>
                <div class="col col-2" data-label="Date">{{$request->created_at}}</div>
            </li>
            @empty
                <h1>NO Requests </h1>
            @endforelse
          </ul>
        </div>
        {{ $serviceRequests->links() }}
    </section>
@endsection
