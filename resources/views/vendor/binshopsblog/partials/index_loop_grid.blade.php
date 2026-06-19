{{--Used on the index page (so shows a small summary--}}

<div class="col-sm-6">
    <div class="edugate-layout-3 news-gird">
        <div class="edugate-layout-3-wrapper">
            <a href="#" class="edugate-image">
                <?=$post->image_tag("medium", true, 'img-responsive'); ?>
            <div class="edugate-content">
                <a href='{{$post->url()}}' style="max-height: 100px" class="title">{{$post->title}}</a>
                <div class="info">
                    <div class="author item"><a href="#">By {{$post->author->name}}</a></div>
                    <div class="date-time item"><a href="#">{{date('d M Y ', strtotime($post->posted_at))}}</a></div>
                </div>
                <div class="info-more">                    
                </div>
                <div class="description">
                    <p>{!! mb_strimwidth($post->post_body_output(), 0, 100, "...") !!}</p>
                </div>
                <a href="{{$post->url()}}" class="btn btn-green"><span>View Post</span></a>
            </div>
        </div>
    </div>
</div>


