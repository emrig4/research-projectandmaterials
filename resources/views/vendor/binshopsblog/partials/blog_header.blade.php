<!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    @if (request()->has('query'))
                        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
                    @else
                        {{ clean(trans('cynoebook::ebooks.ebooks')) }}
                    @endif
                </h2>
                <ol class="breadcrumb">
                    @if (request()->has('query') || request()->has('category'))
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('ebooks.index') }}">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</a></li>
                        
                        @if(request()->has('category'))
                            @if(request()->has('query'))
                                <li><a href="{{ route('ebooks.index', ['category' => request('category')]) }}">{{ request('category') }}</a></li>
                            @else
                                <li class="active">{{ request('category') }}</li>
                            @endif
                        @endif
                        
                        @if(request()->has('query'))
                            <li class="active">{{clean(trans('cynoebook::ebooks.search_results_for')) }}:{{ request('query') }}</li>
                        @endif
                        
                        
                    @else
                        <li><a href="/">Home</a></li>
                        <li class="active">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</li>
                    @endif

                </ol>
            </div>
        </div>
    </div>