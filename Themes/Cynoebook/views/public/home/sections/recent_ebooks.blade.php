@if ($recentEbooks->isNotEmpty())
    <!-- RECENT Books and Materials-->
    <div class="section section-padding top-courses" style="padding: 40px 0">
        <div class="container">
            <div class="group-title-index">
                <h4 class="top-title">{{ $title }}</h4>

                <div class="bottom-title"><i class="bottom-icon icon-icon-04"></i></div>
            </div>
            <div class="top-courses-wrapper">
                <div class="top-courses-slider">
                    
                    @foreach($ebooks as $ebook)
                        <div class="top-courses-item">
                            <div class="edugate-layout-4">
                                <div class="edugate-layout-4-wrapper">
                                    <div class="edugate-content">
                                        <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}" class="title">{{ $ebook->title }}</a>

                                        <div class="info">
                                            @foreach ($ebook->categories as $category)
                                                <div class="date-time item">
                                                    <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                                                        <span style="font-size: 12px">{{ $category->name }}{{ (!$loop->last) ? ', ' : ''}}</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                            <div class="date-time item"><span style="font-size: 12px">{{ $ebook->created_at->diffForHumans() }}</span></div>
                                        </div>

                                        <a href="{{ route('ebooks.show', $ebook->slug) }}" class="btn btn-green">
                                            <span>Download</span>
                                        </a>
                                        
                                    </div>
                                    <div class="edugate-image">
                                       <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">
                                            @if (! $ebook->book_cover->exists)
                                                <img src="{{ asset('themes/cynoebook/public/images/news/news-1.jpg') }}" alt="" class="img-responsive" />
                                            @else
                                                <img src="{{ $ebook->book_cover->path }}" alt="" class="img-responsive">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="group-btn-top-courses-slider">
                    <button onclick="window.location.href='{{ route('ebooks.index', ['sort' => 'latest']) }}'" class="btn btn-green">
                        <span>View all</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
