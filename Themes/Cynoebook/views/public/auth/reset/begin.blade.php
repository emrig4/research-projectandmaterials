@extends('public.layout')

@section('title', clean(trans('user::auth.reset_password')))

@section('content')
    <div class="form-wrapper">
        @include('public.include.notification')

        <div class="page-login rlp">
            <div class="container">
                <div class="login-wrapper rlp-wrapper">

                    <h3>{{ clean(trans('user::auth.reset_password')) }}</h3>
                    <p>{{ clean(trans('user::auth.enter_email')) }}</p>

                    <form method="POST" action="{{ route('reset.post') }}" class="login-form clearfix form-group" >
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control form-input" placeholder="{{ clean(trans('user::attributes.users.email')) }}" autofocus>

                            <div class="input-icon">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>

                            @if($errors->has('email'))
                                <span class="error-message">{{ clean($errors->first('email')) }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-green btn-primary btn-center btn-reset" data-loading>
                            {{ clean(trans('user::auth.reset_password')) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
