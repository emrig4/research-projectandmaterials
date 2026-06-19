@extends('public.layout')

@section('title')
    Services
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ v(Theme::url('public/css/request-form.css')) }}">
    
@endpush

@section('content')
    <!-- page header and breadcrum -->

    <section class="ebook-list">
        <div class="row">
            <div class="section section-padding courses">
                <div class="container ">
                   
                     @if( $service != null  )

                     <!-- request details -->
                    <div class="course-des col-md-6 bg-white" style="padding: 50px; border: 3px solid whitesmoke; border-radius: 10px">
                        <div class="course-des-title underline">{{$service->title}} Service</div>
                        <div class="course-des-content">
                            <p>
                                {{$service->description}}
                            </p>

                            <blockquote>
                                <div class="main-quote">tldr ?</div>
                                <div class="sub-quote">
                                    {{$service->short_description}}
                                </div>
                            </blockquote>
                        </div>
                        <div class="news-list">
                            <div class="list-expand-title">Features</div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <ul class="list-unstyled list-detail">
                                        @php
                                            $features = explode(',',  $service->features)
                                        @endphp
                                        @foreach($features as $feature)
                                            <li>
                                                <i class="fa fa-angle-right"></i>
                                                <a href="#">{{$feature}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                             <div class="list-expand-title">Price</div>
                             <div>
                                 @if($service->price)
                                    <p>{{ $service->price }}</p>
                                @else
                                    <p>Price Estimate will be sent to you</p>
                                @endif
                             </div>
                        </div>
                    </div>


                     <!-- request form -->
                    <div class="col-md-6  ">
                        @include('public.services.partials.request_form', ['service' =>$service])
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script type="text/javascript">
        $("document").ready(function(){
            $("#category-wrapper").css({
                'max-height': (window.screen.availHeight) + 'px',
                'overflow-x': 'auto'
            });
        })

    </script>
@endpush
