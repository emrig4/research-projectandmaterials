<!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    @if (request()->has('query'))
                        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
                    @else
                        {{ $title }}
                    @endif
                </h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('binshopsblog.index') }}">Blog</a></li>
                    <li></li>
                </ol>
            </div>
        </div>
    </div>