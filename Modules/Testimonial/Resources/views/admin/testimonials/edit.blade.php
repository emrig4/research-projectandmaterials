@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Testimonials')

    <li class="nav-item">edit</li>
@endcomponent


@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="pull-left">
                    <h2>Edit Testimonial</h2>
                </div>
                <div class="pull-right">
                    <img style="width: 40px; height: 40px" class="avatar-img rounded-circle" src="{{ $testimonial->avatar() }}">
                </div>
            </div>
            <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" class="form-horizontal"  novalidate>
            {{ csrf_field() }}
            @method('PATCH')
                <div class="card-body">
                    {{ Form::text('name', 'Name', $errors, $testimonial, ['required' => true]) }}

                    {{ Form::text('location', 'Location', $errors, $testimonial, ['required' => false]) }}

                    {{ Form::text('company', 'Company', $errors, $testimonial, ['required' => false]) }}


                    {{ Form::textarea('comment', 'Comment', $errors, $testimonial, ['required' => true]) }}
                    
                    
                    {{ Form::checkbox('is_enabled', 'Is Enabled', '', $errors, $testimonial) }}

                    @include('files::admin.image_picker.category-cover', [
                        'title' => 'Avatar',
                        'inputName' => 'avatar',
                        'file' => $testimonial->avatar,
                    ])
                    
                </div>
                <div class="card-footer">
                    <div class="form-group clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" data-loading>
                                {{ clean(trans('admin::admin.buttons.save')) }}
                            </button>

                            <button type="button" class="btn btn-danger btn-delete-category d-none" data-loading>
                                {{ clean(trans('admin::admin.buttons.delete')) }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" id="categories-delete-form" action="">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            
            </form>
        </div>
    </div>
</div>
@endsection
