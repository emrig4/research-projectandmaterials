@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Services')
    
    <li class="nav-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">Create Service</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="pull-right"><button class="btn btn-primary" onclick='window.location="{{ route ('admin.services.index') }}"'>Back</button></div>
       </div>
    <div class="col-md-12"> <hr></div>
    <div class="col-md-12 " style="background: white; border:  5px solid whitesmoke;">
        <form method="POST" action="{{ route('admin.services.store') }}" class="form-horizontal" id="ebook-create-form">
            {{ csrf_field() }}
           
            <div class=" col-md-6 my-20">
              <label class="label-for-title">Title</label>
              <input type="text" id="title"value="{{old('title')}}" name="title" class="form-control">
              @if($errors->has('title'))
                  <span class="error-message">{{ clean($errors->first('title')) }}</span>
              @endif
            </div>

          
            <div class="col-md-6 my-20 clearfix ">
              <label class="label-for-price col-md-12">Price</label>
              <input type="text" id="price" value="{{old('price')}}" name="price" class="form-control col-md-8 pull-left">
              <select class="form-control col-md-4 pull-right" name="currency_id" id="currency_id">
                <option value="">currency</option>
                @foreach($currencies as $currency)
                  <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                @endforeach
              </select>
                @if($errors->has('currency_id') || $errors->has('price') )
                    <span class="error-message">{{ clean($errors->first('currency_id')) }} | {{ clean($errors->first('price')) }}</span>
                @endif
            </div>

           
            <div class=" col-md-6 my-20">
              <label class="label-for-icon">Icon class</label>
              <input type="text" value="{{old('icon_class')}}" id="icon_class" name="icon_class" class="form-control">
               @if($errors->has('icon_class'))
                  <span class="error-message">{{ clean($errors->first('icon_class')) }}</span>
              @endif
            </div>


            <div class=" col-md-6 my-20">
              <label class="label-for-short_features">Features (comma delimited )</label>
              <input type="text"  value="{{old('features')}}" id="features" name="features" class="form-control">
              @if($errors->has('features'))
                  <span class="error-message">{{ clean($errors->first('features')) }}</span>
              @endif
            </div>


            <div class=" col-md-6 my-20">
              <label class="label-for-short_description">Short Description</label>
              <input type="text" value="{{old('short_description')}}" id="short_description" name="short_description" class="form-control">
              @if($errors->has('short_description'))
                  <span class="error-message">{{ clean($errors->first('short_description')) }}</span>
              @endif
            </div>

           
            <div class=" col-md-6 my-20">
              <label class="label-for-description"> Description</label>
              <textarea cols="4" class="form-control"  name="description" id="description ">{{old('description')}}</textarea>
              @if($errors->has('description'))
                  <span class="error-message">{{ clean($errors->first('description')) }}</span>
              @endif
            </div>


            
            <div class=" col-md-6 my-20">
              <label class="label-for-active"> Is Active</label>
              <input type="checkbox" value="1" name="is_active" id="is_active"  class="form-control">
              @if($errors->has('is_active'))
                  <span class="error-message">{{ clean($errors->first('is_active')) }}</span>
              @endif
            </div>

           
            <div class=" col-md-6 my-20">
              <label class="label-for-featured"> Is Featured</label>
              <input type="checkbox" value="1" name="is_featured" id="is_featured"  class="form-control">
              @if($errors->has('is_featured'))
                  <span class="error-message">{{ clean($errors->first('is_featured')) }}</span>
              @endif
            </div>

            <button type="submit" class="btn btn-primary my-20">Submit</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')

@endpush