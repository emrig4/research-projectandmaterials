{{--Used on the index page (so shows a small summary--}}

<div class="col-md-6" style="margin-bottom: 50px;">
    <div class="edugate-layout-2">
        <div class="edugate-layout-2-wrapper">
            <div class="edugate-image edugate-content">
                <a href='{{$post->url()}}' class="title">{{$post->title}}</a>
               <!--  <h5 class=''>{{$post->subtitle}}</h5> -->
                <!-- <img src="{{ asset('themes/cynoebook/public/images/courses/courses-3.jpg') }}" alt="" class="img-responsive" /> -->
                 <?=$post->image_tag("medium", true, ''); ?>

                 <div class="info pt-10">
                    <div class="author item"><a href="#">By {{$post->author->name}}</a></div>
                    <div class="date-time item"><a href="#">{{date('d M Y ', strtotime($post->posted_at))}}</a></div>
                </div>

                <div class="info-more">
                    <div class="view item"><i class="fa fa-user"></i>
                        <p> 56</p>
                    </div>
                    <div class="comment item"><i class="fa fa-comment"></i>
                        <p> 239</p>
                    </div>
                </div>

                 <a href="{{$post->url()}}" class="btn btn-green"><span>View Post</span></a>
            </div>

            <div class="edugate-content">
                <div class="description">
                    {!! mb_strimwidth($post->post_body_output(), 0, 100, "...") !!}
                </div>
            </div>
            
        </div>
    </div>
</div>


