@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Tags')

    <li class="nav-item">tags</li>
@endcomponent

@section('content')
    <section class="">
       <div class="col-md-12 pb-50">
            
       </div>

        <div class="col-md-12"> <hr></div>
        <div class="pricing-table">
            <div class="row">
                @forelse($tags as $tag)
                    <div class="col-md-4 mb-20">
                        <div class="pricing-option" style="min-height: 0">
                            <h3>{{ $tag->name }}</h3>
                            <span class="price">Count: {{ $tag->count }} </span>
                            <form method="post" action="{{ route('admin.tags.destroy', ['slug' => $tag->slug]) }}">
                                @method('delete')
                                @csrf
                                <input type="submit" value="Delete" name="">
                            </form>
                            <hr />
                        </div>
                    </div>
                @empty
                    <h1 class="">NO TAGS FOUND</h1>
                @endforelse

                {!! $tags->links() !!}
            </div>
        </div>

    </section>
@endsection
