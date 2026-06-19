    <form action="{{ route('ebooks.index') }}" method="GET" id="search-box-form">
        <div class="search-box">
        <input type="text" name="query" class="search-box-input" placeholder="{{ clean(trans('cynoebook::layout.search_for_ebooks')) }}" value="{{ request('query') }}">
        <div class="search-box-button">
            <button class="search-box-btn btn btn-primary" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <select name="category" class="select search-box-select custom-select-black">
                <option value="" selected>{{ clean(trans('cynoebook::layout.categories')) }}</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    </form>

 
            