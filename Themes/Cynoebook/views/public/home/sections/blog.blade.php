<!--LATEST NEWS-->
<div class="section section-padding latest-news">
    <div class="container">
        <div class="group-title-index">
            <h4 class="top-title">latest articles</h4>

            <h2 class="center-title">Resource Center</h2>

            <div class="bottom-title"><i class="bottom-icon icon-a-01-01"></i></div>
        </div>

        <div class="latest-news-wrapper row " >
            @foreach($featuredPosts as $post)
                <div class="col-md-6" style="margin-bottom: 50px;">
                    <div class="edugate-layout-2">
                        <div class="edugate-layout-2-wrapper">
                            <div class="edugate-content"><a href="{{$post->url()}}" class="title">{{ $post->title }}</a>

                                <div class="info">
                                    <div class="author item"><a href="#">By {{ $post->author->last_name}}</a></div>
                                    <div class="date-time item"><a href="#">{{ $post->created_at->diffForHumans() }}</a></div>
                                </div>
                                <div class="info-more">
                                    <!-- <div class="comment item"><i class="fa fa-comment"></i>

                                        <p>   post->comments()->count() </p>
                                    </div> -->
                                </div>
                                
                                <div class="description">
                                    {!! mb_strimwidth($post->short_description, 0, 100, "...") !!}
                                </div>
                               <a href="{{$post->url()}}" class="btn btn-green"><span>Learn More</span></a>
                            </div>
                            <div class="edugate-image">
                                 <?=$post->image_tag("medium", true, 'img-responsive'); ?>
                                <!-- <img src="{{ asset('themes/cynoebook/public/images/courses/courses-3.jpg') }}" alt="" class="img-responsive" /> -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('binshopsblog.index') }}" class="btn btn-green btn-latest-new col-md-12">
                <span>Browser All Post<i class="fa fa-long-arrow-right"></i></span>
            </a>
        </div>
    </div>
</div>