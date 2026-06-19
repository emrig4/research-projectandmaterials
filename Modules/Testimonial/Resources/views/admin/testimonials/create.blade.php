@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Testimonials')

    <li class="nav-item">create</li>
@endcomponent

@php
    $testimonial = Modules\Testimonial\Entities\Testimonial::firstOrCreate([]);
@endphp

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="">
                    <h2>Create Testimonial</h2>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.testimonials.store') }}" class="form-horizontal"  novalidate>
            {{ csrf_field() }}
                <div class="card-body">
                    {{ Form::text('name', 'Name', $errors, null, ['required' => true]) }}

                    {{ Form::text('location', 'Location', $errors, null, ['required' => false]) }}

                    {{ Form::text('company', 'Company', $errors, null, ['required' => false]) }}


                    {{ Form::textarea('comment', 'Comment', $errors, null, ['required' => true]) }}
                    
                    
                    {{ Form::checkbox('is_enabled', 'Is Enabled', '', $errors) }}

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
