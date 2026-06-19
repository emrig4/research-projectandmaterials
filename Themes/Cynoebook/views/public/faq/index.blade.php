@extends('public.layout')

@prepend('styles')
<link rel="stylesheet" href="{{ v(Theme::url('public/css/faq.css')) }}">

<style type="text/css">
  .cd-faq__category::before, .cd-faq__category::after {
    background-color: #f70000;
    background-color: #f70000);
  }

  .cd-faq__trigger::before, .cd-faq__trigger::after {
    background: #968b8b61;
    background: #968b8b61;
  }

  .cd-faq__title{
    background: white;
    padding: 20px;
    border-top: thick solid #968b8b61;
    font-size: 2em;
    margin-bottom: 5px;
}
</style>
@endprepend


@section('content')
<!-- page header and breadcrum -->
<div class="section background-opacity page-title set-height-top">
    <div class="container">
        <div class="page-title-wrapper">
            <h2 class="captions">
                @if (request()->has('query'))
                    {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
                @else
                    {{ 'FAQS' }}
                @endif
            </h2>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">{{ 'Tags' }}</li>
            </ol>
        </div>
    </div>
</div>

<!-- search -->
<!-- include('public.include.search_ebook') -->

<div class="section section-padding">
  <section class="container">
      <div class="group-title-index"><h4 class="top-title">Answer all of your questions</h4>
        <h2 class="center-title">FREQUENTLY ASKED QUESTIONS</h2>
        <div class="bottom-title"><i class="bottom-icon icon-icon-05"></i></div>
      </div>
  </section>

  <section class="cd-faq js-cd-faq container max-width-md margin-top-lg margin-bottom-lg">
      <ul class="cd-faq__categories" >
          @foreach($categories as $category)
              <li><a class="cd-faq__category truncate bg-light" href="#{{ $category->name }}">{{ $category->name }}</a></li>
          @endforeach
      </ul> <!-- cd-faq__categories -->

      <div class="cd-faq__items">
        @foreach($categories as $category)
            <ul id="{{ $category->name }}" class="cd-faq__group">
                <li class="cd-faq__title"><h2>{{$category->name}}</h2></li>
                @foreach($category->faqs as $faq)
                <li class="cd-faq__item">
                    <a class="cd-faq__trigger" href="#0"><i class="fa fa-caret-down" style="font-size: 20px"></i><span> {{$faq->question}}</span></a>
                    <div class="cd-faq__content">
                        <div class="text-component">
                            <p>{{$faq->answer}}</p>
                        </div>

                        <div id="faq-footer-{{ $faq->id }}" class="card-footer" style="border-top: 1px solid #ddd;">
                            <div class="btn-group btn-group-sm">
                                @csrf
                                <span class="btn" style="padding-left: 0px;">Was this question helpful?</span>
                                <a class="btn btn-success btn-helpful mx-3" href="#" data-id="{{ $faq->id }}" data-type="helpful_yes">
                                    <i class="fa fa-thumbs-up"></i> Yes
                                </a>
                                <a class="btn btn-danger btn-helpful mx-3" href="#" data-id="{{ $faq->id }}" data-type="helpful_no">
                                    <i class="fa fa-thumbs-down"></i> No
                                </a>
                            </div>
                        </div>
                    </div> <!-- cd-faq__content -->
                </li>
                 @endforeach
            </ul> <!-- cd-faq__group -->
        @endforeach
      </div> <!-- cd-faq__items -->
      <a href="#0" class="cd-faq__close-panel text-replace">Close</a>
    <div class="cd-faq__overlay" aria-hidden="true"></div>
  </section> <!-- cd-faq -->

  <section class=" container mt-50">
    <div class="row contact-method">
      <div class=" col-md-12">
        <div class="underline">Didn't find the answer?</div>
           <form method="POST" action="{{ route('contact.store') }}" style="padding-top: 0" class="bg-w-form contact-form clearfix">
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

    </div>
  </section>
</div>




@endsection

@push('scripts')
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#faq-box')
                .on('show.bs.collapse', function (e) {
                    $.post('/faq/question/' + $(e.target).attr('data-id'));

                    $(e.target).parents('.card').addClass('card-info');
                })
                .on('hide.bs.collapse', function (e) {
                    $(e.target).parents('.card').removeClass('card-info');
                });

            $('.btn-helpful').on('click', function (e) {
                e.preventDefault();
                
                // show spinner
                var $footer = $('#faq-footer-' + $(this).attr('data-id'));
                $footer.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");

                // post and show response
                // $.post('/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'), function () {
                //     $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
                // });
                
                $.ajax({
                  headers: {
                  'X-CSRF-TOKEN': $('input[name$="_token"]').attr('value')
                  },
                  url: '/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'),
                  
                  type: 'POST',
                  data: {},
                  contentType: false,
                  processData: false,
                  success:function(response) {
                       console.log(response);
                       $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
                  }
                });
                return false;
            });
        })
    </script>

    
    
    
@endpush