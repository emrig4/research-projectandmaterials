<div class="">
    <div class="ebook-image hidden-xs">
        <div class="base-image">
            @if (! $ebook->book_cover->exists)
                <div class="image-placeholder">
                    <i class="fa fa-picture-o"></i>
                </div>
            @else
                <a class="base-image-inner" href="{{ $ebook->book_cover->path }}">
                    <img src="{{ $ebook->book_cover->path }}" alt="{{ $ebook->name }}">
                </a>
            @endif
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="socials">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="facebook">
            <i class="fa fa-facebook"></i>
        </a>
        <!-- <a href="#" class="google"><i class="fa fa-google-plus"></i></a> -->
        <a target="_blank" href="https://twitter.com/intent/tweet?text={{ $ebook->title }}&url={{ url()->current() }}" class="twitter">
            <i class="fa fa-twitter"></i>
        </a>

        <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&media={{ $ebook->book_cover->path }}&description={{ $ebook->title }}" target="_blank" class="pinterest">
            <i class="fa fa-pinterest"></i>
        </a>
        <!-- <a href="#" class="blog"><i class="fa fa-rss"></i></a> -->
        <!-- <a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a> -->
        <a target="_blank"href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $ebook->title }}" class="linkedin">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
        </a>
        <a href="mailto:?subject=eBook-{{$ebook->title}}&amp;body=Check out this eBook {{ route('ebooks.show', $ebook->slug) }}" >
            <i class="fa fa-envelope"></i>
        </a>
    </div>    
</div>

