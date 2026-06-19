@extends('public.layout')

@section('title', clean(trans('user::auth.sign_up')))

@section('content')
    <div class="form-wrapper">
        <br/>
        @include('public.include.notification')
        <div class="content">
            <div class="page-register rlp">
                <div class="container">
                    <div class="register-wrapper rlp-wrapper">
                        <div class="register-table rlp-table"><a href="index-2.html"><img src="assets/images/logo-color-1.png" alt="" class="login"/></a>

                            <div class="register-title rlp-title">{{ clean(trans('user::auth.sign_up')) }}</div>
                            <form method="POST" action="{{ route('register.post') }}">
                                {{ csrf_field() }}
                                <div class="register-form bg-w-form rlp-form">
                                    <div class="row">
                                        <!-- first name -->
                                        <div class="col-md-6 {{ $errors->has('first_name') ? 'has-error': '' }}">
                                            <label for="regname" class="control-label form-label">
                                                {{ clean(trans('user::auth.first_name')) }}
                                                <span class="highlight">*</span>
                                            </label>

                                            <input type="text" name="first_name" value="{{ old('first_name') }}"  class="form-control form-input" id="first-name" autofocus required>

                                            @if($errors->has('first_name'))
                                                <span class="error-message">{{ clean($errors->first('first_name')) }}</span>
                                            @endif
                                        </div>
                                        <!-- last name -->
                                        <div class="col-md-6 {{ $errors->has('last_name') ? 'has-error': '' }}">
                                            <label for="regname" class="control-label form-label">
                                                {{ clean(trans('user::auth.last_name')) }}
                                                <span class="highlight">*</span>
                                            </label>

                                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control form-input" id="last-name">

                                            @if($errors->has('last_name'))
                                                <span class="error-message">{{ clean($errors->first('last_name')) }}</span>
                                            @endif
                                        </div>


                                        <!-- username -->
                                        <div class="col-md-6 {{ $errors->has('username') ? 'has-error': '' }}">
                                            <label for="regname" class="control-label form-label">
                                                {{ clean(trans('user::auth.username')) }}
                                                <span class="highlight">*</span>
                                            </label>

                                            <input type="text" name="username" value="{{ old('username') }}" class="form-control form-input" id="username">

                                            @if($errors->has('username'))
                                                <span class="error-message">{{ clean($errors->first('username')) }}</span>
                                            @endif
                                        </div>

                                        
                                        <!-- email -->
                                        <div class="col-md-6 {{ $errors->has('email') ? 'has-error': '' }}">
                                            <label for="regemail" class="control-label form-label">
                                                {{ clean(trans('user::auth.email')) }}
                                                <span class="highlight">*</span>
                                            </label>
                                            <input type="text" name="email" value="{{ old('email') }}" class="form-control form-input" id="email">
                                            @if($errors->has('email'))
                                                <span class="error-message">{{ clean($errors->first('email')) }}</span>
                                            @endif
                                        </div>


                                        <!-- password -->
                                        <div class="col-md-6 form-group {{ $errors->has('password') ? 'has-error': '' }}">
                                            <label for="regpassword" class="control-label form-label">
                                                {{ clean(trans('user::auth.password')) }}
                                                <span class="highlight">*</span>
                                            </label>
                                            <input type="password" name="password" class="form-control form-input" id="password">
                                            @if($errors->has('password'))
                                                <span class="error-message">{{ clean($errors->first('password')) }}</span>
                                            @endif
                                        </div>

                                        <!-- confirm password -->
                                        <div class="col-md-6 form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                                            <label for="reregpassword" class="control-label form-label">
                                                {{ clean(trans('user::auth.password_confirmation')) }}
                                                <span class="highlight">*</span>
                                            </label>
                                            <input type="password" name="password_confirmation" class="form-control form-input" id="confirm-password">
                                            @if($errors->has('password_confirmation'))
                                                <span class="error-message">{{ clean($errors->first('password_confirmation')) }}</span>
                                            @endif
                                        </div>

                                    </div>
                                
                                    <div class="row">
                                        <!-- captcha -->
                                        <div class="col-md-12 form-group {{ $errors->has('g-recaptcha-response') ? 'has-error': '' }} ">
                                            
                                            {!! app('captcha')->display() !!}

                                            @if($errors->has('g-recaptcha-response'))
                                                <span class="error-message">{{ clean($errors->first('g-recaptcha-response')) }}</span>
                                            @endif

                                        </div>

                                    </div>

                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-12 checkbox">
                                            <input type="checkbox" name="privacy_policy" id="privacy">
                                            <label for="privacy">
                                                {{ clean(trans('user::auth.i_agree_to_the')) }} <a href="{{ $privacyPageURL }}">{{ clean(trans('user::auth.privacy_policy')) }}</a>
                                            </label>

                                            @if($errors->has('privacy_policy'))
                                                <span class="error-message">{{ clean($errors->first('privacy_policy')) }}</span>
                                            @endif
                                        </div>

                                        <br/>
                                        <div class="col-md-12 text-center register-submit">
                                            <button type="submit" data-loading class="btn btn-register btn-green">
                                                <span>{{ clean(trans('user::auth.sign_up')) }}</span>
                                            </button>
                                        </div>

                                        <div class="col-md-12 text-center login-account  ">
                                            <span class="msg">{{ clean(trans('user::auth.already_have_account')) }}</span>
                                            <a href="{{ route('login')  }}" id="show-signup" class="link">{{ clean(trans('user::auth.sign_in')) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-padding"></div>
    </div>
@endsection