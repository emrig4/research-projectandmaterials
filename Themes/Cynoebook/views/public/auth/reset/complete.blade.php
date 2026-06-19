@extends('public.layout')

@section('title', clean(trans('user::auth.reset_password')))

@section('content')
    <div class="form-wrapper">
        @include('public.include.notification')

        <div class="form-page">
            <<div class="page-login rlp">
                <div class="container">
                    <div class="login-wrapper rlp-wrapper">
                    <div class="form-inner">
                        <h3>{{ clean(trans('user::auth.reset_password')) }}</h3>

                        <form method="POST" action="{{ route('reset.complete.post', [$user->email, $code]) }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('new_password') ? 'has-error': '' }}">
                                <input type="password" name="new_password" class="form-control form-input" placeholder="{{ clean(trans('user::attributes.users.new_password')) }}" autofocus>

                               
                                @if($errors->has('new_password'))
                                    <span class="error-message">{{ clean($errors->first('new_password')) }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error': '' }}">
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="{{ clean(trans('user::attributes.users.new_password_confirmation')) }}">

                                

                                @if($errors->has('new_password_confirmation'))
                                    <span class="error-message">{{ clean($errors->first('new_password_confirmation')) }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-green btn-primary btn-center btn-reset" data-loading>
                                <span>{{ clean(trans('user::auth.reset_password')) }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
