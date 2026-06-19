@push('styles')
    <style type="text/css">
        img.media-image {
            width: 70px;
        }
    </style>
@endpush

@php
    //pick first 10 post from db
    $posts = BinshopsBlog\Models\BinshopsBlogPost::limit(10)->get();

@endphp
<div class="recent-post-widget widget col-md-12 sd380">
    <div class="title-widget">recent post</div>
    <div class="content-widget">
        @foreach($posts as $post)
            <div class="media">
                <div class="media-left">
                    <a href="{{ $post->url() }}" class="link">
                        <?=$post->image_tag("thumbnail", true, 'media-image'); ?>
                    </a>
                </div>
                <div class="media-right">
                    <div class="info">
                        <div class="date-created item">
                            <a href="#"><span>{{date('d M Y ', strtotime($post->posted_at))}}</span></a>
                        </div>
                    </div>
                </div>
                 <a href="{{ $post->url() }}" class="link title">{{ $post->title }}</a>
            </div>
        @endforeach
    </div>
</div>