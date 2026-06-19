<div class="tag-widget widget sd380">
    <div class="title-widget">top tags</div>
    <div class="content-widget">
        <ul class="tag-widget list-unstyled">
            @foreach($topTags as $tag)
                <li><a href="{{ route('ebooks.index', ['tag' => $tag->slug, 'page' => 1]) }}" class="tag-item">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>  