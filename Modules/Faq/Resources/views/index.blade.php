@extends('layouts.app', [
  'pageName' => 'faq'
])

@prepend('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/nominees.css') }}">
<link rel="stylesheet" href="{{asset('css/faq.css')}}">

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
<main class="nominees-page">
  <section class="lead">
        <div>
            <div class="lead-text">
                <img style="width: 150px" src="{{asset('images/faq2.png') }}" alt="">
                <h3>Frequently Asked Questions</h3>
            </div>
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
                <a class="cd-faq__trigger" href="#0"><span>{{$faq->question}}</span></a>
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
</main>




@endsection

@push('js')
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
    
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <script src="{{asset('js/faq/util.js')}}"></script> 
    <script src="{{asset('js/faq/main.js')}}"></script> 
@endpush