@extends('public.layout')

@section('title', clean(trans('user::auth.sign_in')))

@section('content')
    <div class="form-wrapper">
        <br/>
        @include('public.include.notification')

        <div class="page-login rlp">
            <div class="container">
                <div class="login-wrapper rlp-wrapper">
                    <form method="POST" action="{{ route('login.post') }}" class="login-form clearfix form-group" >
                    {{ csrf_field() }}
                        <div class="login-table rlp-table"><a href="index-2.html"><img src="assets/images/logo-color-1.png" alt="" class="login"/></a>

                            <div class="login-title rlp-title">{{ clean(trans('user::auth.sign_in')) }}</div>
                            <div class="login-form bg-w-form rlp-form">
                                <div class="row">
                                    <div class="col-md-12 {{ $errors->has('email') ? 'has-error': '' }}">
                                        <label for="regemail" class="control-label form-label">
                                            {{ clean(trans('user::auth.email')) }}
                                            <span class="highlight">*</span>
                                        </label>
                                        
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control form-input" id="email" placeholder="{{ clean(trans('user::attributes.users.email')) }}" >

                                        @if($errors->has('email'))
                                            <span class="error-message">{{ clean($errors->first('email')) }}</span>
                                        @endif

                                    </div>
                                    <div class="col-md-12 {{ $errors->has('password') ? 'has-error': '' }}">
                                        <label for="regpassword" class="control-label form-label">
                                            {{ clean(trans('user::auth.password')) }}
                                            <span class="highlight">*</span>
                                        </label>
                                        <input type="password" name="password" class="form-control form-input" id="password" placeholder="{{ clean(trans('user::attributes.users.password')) }}">

                                        @if($errors->has('password'))
                                            <span class="error-message">{{ clean($errors->first('password')) }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="login-submit">
                                <div class="checkbox">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" value="1" id="remember">

                                    <label for="remember">{{ clean(trans('user::auth.remember_me')) }}</label>
                                </div>
                                <button type="submit"  class="btn btn-login btn-green" data-loading>
                                    <span>{{ clean(trans('user::auth.sign_in')) }}</span>
                                </button>

                                <hr>    
                                <a href="{{ route('reset') }}" class="forgot-password">
                                    {{ clean(trans('user::auth.forgot_password')) }}
                                </a>
                            </div>



                            <hr />
                            @if(setting('enable_registrations'))
                            <div class="login-account text-center">
                                <span class="msg">{{ clean(trans('user::auth.dont_have_an_account_yet')) }}</span>
                                <a href="{{ route('register')  }}" id="show-signup" class="link">{{ clean(trans('user::auth.sign_up')) }}</a>
                            </div>
                            @endif
                            <div class="clearfix"></div> 


                             <!-- social regis -->
                            <div class="clearfix"></div> 
                            <div class="social-login-buttons text-center">
                                @if (count(app('enabled_social_login_providers')) !== 0)
                                    <div class="my-20  ">
                                        <span class="hline-innertext btn-primary">{{ clean(trans('user::auth.or')) }}</span>
                                    </div>
                                    
                                @endif

                                @if (setting('facebook_login_enabled'))
                                    <a href="{{ route('login.redirect', ['provider' => 'facebook']) }}" class="mt-10 btn btn-green" style=" background:#4267b2;">
                                        <i class="fa fa-facebook fa-fw"></i>
                                       <span> {{ clean(trans('user::auth.log_in_with_facebook')) }}</span>
                                    </a>
                                @endif

                                @if (setting('google_login_enabled'))
                                    <a href="{{ route('login.redirect', ['provider' => 'google']) }}" class="mt-10 btn btn-green" style="background:#dd4b39;">
                                        <i class="fa fa-google fa-fw"></i>
                                        <span>{{ clean(trans('user::auth.log_in_with_google')) }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection
