@if ($carouselEbooks->isNotEmpty())
    <!--Featured Books-->
    <div class="section section-padding latest-news" style="padding: 40px 0">
        <div class="container">
            <div class="group-title-index" style="margin-bottom: 20px">
                <h5 class="top-title">{{ $title }}</h5>

                <h2 class="center-title">{{ $title }} </h2>

                <div class="bottom-title"><i class="bottom-icon icon-a-01-01"></i></div>
            </div>

            <div class="latest-news-wrapper row " >
                <div class="top-courses-slider">
                    @foreach($carouselEbooks as $ebook)
                        <div class="col-md-12">
                            <div class="edugate-layout-1">
                                <div class="edugate-image">
                                    <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">
                                        @if (! $ebook->book_cover->exists)
                                            <img src="{{ asset('themes/cynoebook/public/images/news/news-1.jpg') }}" alt="" class="img-responsive" />
                                        @else
                                            <img src="{{ $ebook->book_cover->path }}" alt="" class="img-responsive">
                                        @endif
                                    </a>
                                </div>
                                <div class="edugate-content">
                                    <a href="{{ route('ebooks.show', $ebook->slug) }}" class="title">{{ $ebook->title }}</a>

                                    <div class="info">
                                       <!--  <div class="author item"><a href="#">By Admin</a></div> -->
                                        <!-- <div class="date-time item"><a href="#">17 sep 2015</a></div> -->
                                    </div>
                                    <div class="info-more">
                                        @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
                                    <div class="div-ellipsis ebook-category" data-toggle="tooltip" data-placement="top" title="{{ $ebook->implodeCategories() }}">
                                         <i class="fa fa-folder-o"></i> In {{mb_strimwidth($ebook->implodeCategories(), 0, 10, "...") }}
                                    </div>
                                    </div>
                                    <div class="description">{!! $ebook->description !!}...</div>
                                    <a href="{{ route('ebooks.show', $ebook->slug) }}" class="btn btn-green">
                                        <span>Download</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
