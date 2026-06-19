<div class="section">
    <div class="search-input">
        <div class="container">
            <div class="search-input-wrapper">
                <form action="{{ route('ebooks.index') }}" method="GET" id="search-box-form">
                    <select name="category" class="form-select style-1 selectbox">
                        <option value="" selected>{{ clean(trans('cynoebook::layout.categories')) }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" style="width: 60% !important" name="query" class="form-input" placeholder="search for project topics and materials" value="{{ request('query') }}">

                    <button type="submit" class="form-submit btn btn-blue"><span>search now<i class="fa fa-search"></i></span></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
 
            