<style type="text/css">
    .flex-row-container{
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .flex-row-container > .flex-row-item {
        flex: 1 1 30%;
        height: 110px
    }

    @media screen and (max-width: 767px){
        .flex-row-container > .flex-row-item {
            flex: 1 1 100%;
        }
    }

    .flex-row-item {

    }
</style>

<div class="progress-bars-content">
    <div class="group-title-index">
        <h4 class="top-title">Top Categories</h4>
        <h2 class="center-title">Browse Top Categories</h2>
        <div class="bottom-title"><i class="bottom-icon icon-icon-04"></i></div>
    </div>

    <div class="">

        <div class="col-md-12" style="padding: 0;">
            <div class="category-card sd380">
                <div class="content-card">
                    <ul class="category-card list-unstyled flex-row-container">
                        @foreach($featuredCategories as $featuredCategory)
                            <li class="flex-row-item " style="text-transform: uppercase; margin: auto"><a href="{{ route('ebooks.index', ['category' => $featuredCategory->slug])}}" class="link cat-item"><span class="pull-">{{$featuredCategory->name}}</span><span class=" pull-right pill">{{$featuredCategory->count}}</span></a></li>
                            <!-- $featuredCategory->count -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>