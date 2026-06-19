@php
    //pick first 10 post from db
    $categories = BinshopsBlog\Models\BinshopsBlogCategory::limit(10)->get();

@endphp
<div class="category-widget widget col-md-12  sd380">
    <div class="title-widget">categories</div>
    <div class="content-widget">
        <ul class="category-widget list-unstyled">
            @forelse($categories as $category)
                <li>
                    <a href='{{$category->url()}}' class="link cat-item">
                        <span> {{$category->category_name}}</span>
                        <span class="pull-right">{{$category->posts()->count()}}</span>
                    </a>
                </li>
            @empty
                <p>No Category</p>
            @endforelse
        </ul>
    </div>
</div>