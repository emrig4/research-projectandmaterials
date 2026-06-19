@if ($ebooks->isNotEmpty())
    <div class="section section-padding latest-news" style="padding: 40px 0">
        <div class="latest-news-wrapper row " >
            <div class="top-courses-slider">
                    @foreach ($ebooks as $ebook)
                         <div class="col-md-12">
                    <div class="edugate-layout-1">
                        <div class="edugate-image">
                            @if (! $ebook->book_cover->exists)
                                <img src="{{ asset('themes/cynoebook/public/images/news/news-1.jpg') }}" alt="" class="img-responsive" />
                            @else
                                <img src="{{ $ebook->book_cover->path }}" class="img-responsive">
                            @endif
                        </div>
                        <div class="edugate-content">
                            <a href="{{ route('ebooks.show', $ebook->slug) }}" class="title">{{$ebook->title}}</a>

                            <div class="info-more">
                                <div class="more-details-wrapper">
                                    @if($ebook->isFavorite())
                                        <form method="POST" action="{{ route('account.favorite.destroy',$ebook) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">   
                                        
                                            <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::ebook_card.remove_from_favorite')) }}">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    @else   
                                    <form method="POST" action="{{ route('favorite.store') }}">
                                        {{ csrf_field() }}
                                            
                                        <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                            <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::ebook_card.add_to_favorite')) }}">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    @endif 
                                    @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
                                    <div class="div-ellipsis ebook-category" data-toggle="tooltip" data-placement="top" title="{{ $ebook->implodeCategories() }}">
                                         <i class="fa fa-folder-o"></i> In {{mb_strimwidth($ebook->implodeCategories(), 0, 10, "...") }}
                                    </div>
                                </div>
                            </div>
                
                            <div class="description"> {!! $ebook->description !!} </div>
                            <button onclick="window.location.href='{{ route('ebooks.show', $ebook->slug) }}'" class="btn btn-green">
                                <span>Download</span>
                            </button>
                        </div>
                    </div>
                </div>
                    @endforeach
                       

            </div>
        </div>
    </div>
@endif
