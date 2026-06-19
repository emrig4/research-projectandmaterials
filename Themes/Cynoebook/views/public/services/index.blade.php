@extends('public.layout')

@push('meta')
    <meta name="description" content="{{ setting('meta_description_services_page') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_services_page') }}">
@endpush
@section('title')
    Services
@endsection

@section('content')
    <!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <ul class="list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="ebook-list">
        <div class="row">
            <div class="section section-padding courses">
                <div class="container">
                    <div class="group-title-index">
                        <h2 class="center-title">Service Listings</h2>
                        <h4 class="top-title">
                            You just a few clicks away from getting a top notch and <b><a href="/request">professional</a></b> assistance
                        </h4>
                    </div>

                    <div class="courses-wrapper">

                        <div class="col-md-12">
                            <div class="tab-content book-listings ">
                                <div id="all" role="tabpanel" class="tab-pane fade in active">
                                    <div class="style-show style-grid row">
                                       @forelse ($services as $service)
                                            <div class="col-md-6">
                                               @include('public.services.partials.service_card', ['service' => $service]) 
                                            </div>
                                        @empty
                                            <h3>No service found</h3>
                                        @endforelse
                                    </div>
                                </div>
                                 <div class="  col-md-12 section-padding">
                                    @if( ($services->links() ))
				                        {{ $services->links('public.include.paginator') }}
                                    @endif
				                </div>
                            </div>
                        </div>

                        <!-- Sidepane -->
                        <div class="col-md-2 category-sidepane">
                            <!-- include('public.ebooks.partials.sidepane') -->
                        </div>
                    </div>
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
