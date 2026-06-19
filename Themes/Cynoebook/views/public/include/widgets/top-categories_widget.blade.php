<div class="category-widget widget sd380">
    <div class="title-widget">Top categories</div>
    <div class="content-widget">
        <ul class="category-widget list-unstyled">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route( 'ebooks.index', ['category' => $category->slug, 'page' => 1] ) }}" class="link cat-item">
                        <span class="pull-left">{{ $category->name }}</span>
                        <span class="pull-right">{{ $category->count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>