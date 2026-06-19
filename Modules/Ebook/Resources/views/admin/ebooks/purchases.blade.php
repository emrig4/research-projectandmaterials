@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('ebook::ebooks.ebooks')))

    <li class="nav-item">{{ clean(trans('ebook::ebooks.ebooks')) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Purchased EBooks</h2>
            </div>
            <div class="card-body">
                <table class="display table table-striped table-hover">
                    <thead>
                        <tr>
                           
                            <th>Book Cover</th>
                            <th>Book Title</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount Paid</th>
                            <th>Download Count</th>
                            <th>Channel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchasedEbooks as $purchasedEbook)
                            @if($purchasedEbook->ebook)
                                <tr>
                                <td><img src="{{ $purchasedEbook->ebook->book_cover->path  }}" style="width: 30px"></td>
                                <td>{{ $purchasedEbook->ebook->title  }}</td>
                                <td>{{ $purchasedEbook->customer->email  }}</td>
                                <td>{{ $purchasedEbook->created_at->diffForHumans()  }}</td>
                                <td>{{ $purchasedEbook->transaction->amount  }}</td>
                                <td>{{ $purchasedEbook->download_count  }}</td>
                                 <td>{{ $purchasedEbook->transaction->payment_aggregator  }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $purchasedEbooks->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        new DataTable('#ebooks-table .table', {
            columns: [
            ],
        });
    </script>
@endpush
