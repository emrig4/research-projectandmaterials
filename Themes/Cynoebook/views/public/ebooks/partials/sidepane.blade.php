<h4>Browse Categories</h4>
<div id="category-wrapper" class="">
    <div class="ebook-list-sidebar clearfix">
        @if ($categories->isNotEmpty())
            <div class="filter-section clearfix">
                <ul class="filter-category list-inline">
                    @foreach ($categories as $category)
                        <li class="{{ request('category') === $category->slug ? 'active' : '' }}">
                            <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'page' => 1]) }}">
                                {{ $category->name }}
                            </a>

                            @if ($category->items->isNotEmpty())
                                @include('public.ebooks.partials.sub_category_filter', ['subCategories' => $category->items])
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>    
</div>

