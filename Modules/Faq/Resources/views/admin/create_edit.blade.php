@extends('layouts.dash', [
    'class' => '',
    'elementActive' => 'faq'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <form class="" name="create-faq" action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Create FAQ') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Question') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea name="question" class="form-control" rows="3"></textarea>
                                </div>
                                @if ($errors->has('question'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Answer') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea name="answer" class="form-control" rows="3"></textarea>
                                </div>
                                @if ($errors->has('answer'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control" name="category_id">
                                        <option>Select category</option>
                                        @foreach($categories as $category)
                                            <option class="form-control" value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-info btn-flat">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        </div>
        <div class="row d-flex">
            <div class="col-md-10 offset-md-1">
                <form class="" id="create-category" name="create-category" action="{{ route('faqs.categories.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Create FAQ Category') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-info btn-flat">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initSummerNote('.summernote');

            $('#form-edit').on('submit', function ()
            {
                $('#answer-content').html($('.summernote').val());
                return true;
            });
        })
    </script>
@endsection
