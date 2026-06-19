@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_contact_page') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_contact_page') }}">
@endpush
@section('title', clean(trans('cynoebook::contact.contact')))

@section('content')
    <section class="content">
        <div class="section background-opacity page-title set-height-top">
            <div class="container">
                <div class="page-title-wrapper"><!--.page-title-content--><h2 class="captions">Contact</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active"><a href="#">Contact</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="section section-padding contact-main">
            <div class="container">
                <div class="contact-main-wrapper">

                    <!-- contact cards -->
                    <div class="row contact-method">
                        <div class="col-md-4">
                            <div class="method-item"><i class="fa fa-map-marker"></i>

                                <p class="sub">COME TO</p>

                                <div class="detail">
                                    <p>{{ setting('contact_address_line1') }}</p>
                                    <p>{{ setting('contact_address_line2') }}</p>
                                    <p>{{ setting('contact_address_line3') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="method-item"><i class="fa fa-phone"></i>

                                <p class="sub">CALL TO</p>

                                <div class="detail">
                                    <p>{{ setting('contact_phone1') }}</p>
                                    <p>{{ setting('contact_phone2') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="method-item"><i class="fa fa-envelope"></i>

                                <p class="sub">CONNECT TO</p>

                                <div class="detail">
                                    <p>{{ setting('contact_email') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- contact info and form -->
                    <div class="row contact-method">
                        <div class=" col-md-8">
                             <form method="POST" action="{{ route('contact.store') }}" class="bg-w-form contact-form clearfix">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                            <label class="control-label form-label">FIRST NAME <span class="highlight">*</span></label>
                                            <input type="text" placeholder="" id="first_name" name="first_name" class="form-control form-input"/>
                                            @if($errors->has('first_name'))
                                                <span class="error-message">{{ clean($errors->first('first_name')) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                                            <label class="control-label form-label">LAST NAME <span class="highlight">*</span></label>
                                            <input type="text" placeholder="" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control form-input"/>
                                             @if($errors->has('last_name'))
                                                <span class="error-message">{{ clean($errors->first('last_name')) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                            <label class="control-label form-label">EMAIL<span class="highlight">*</span></label>
                                             <input type="text" name="email" class="form-control form-input" id="email" value="{{ old('email') }}">
                                             @if($errors->has('email'))
                                                <span class="error-message">{{ clean($errors->first('email')) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('subject') ? 'has-error': '' }}">
                                            <label class="control-label form-label">SUBJECT</label>
                                            <input type="text" name="subject" class="form-control form-input" id="subject" value="{{ old('subject') }}">
                                            @if($errors->has('subject'))
                                                <span class="error-message">{{ clean($errors->first('subject')) }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="contact-question form-group {{ $errors->has('message') ? 'has-error': '' }} ">
                                            <label class="control-label form-label">HOW CAN WE HELP? <span class="highlight">*</span></label>
                                            <textarea class="form-input form-control" name="message" cols="30" rows="10" id="message">{{ old('message') }}</textarea>
                                            @if($errors->has('message'))
                                                <span class="error-message">{{ clean($errors->first('message')) }}</span>
                                            @endif
                                        </div>
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
                                    
                                <div class="contact-submit">
                                    <button type="submit" class="btn btn-contact btn-green"><span>SUBMIT CONTACT</span></button>
                                </div>
                            </form>
                        </div>

                        <!-- contact page info -->
                        <div class="col-md-4">
                            <div class="bg-w-form contact-form clearfix">
                                {!! setting('contact_info') !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="map" class="section contact-map"></div>
    </section>

@endsection
