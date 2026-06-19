<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
    <div class="ebook-details">
        <h2 class="ebook-name">
        @if($ebook->isPasswordProtected())
            <i class="fa fa-lock has-error" aria-hidden="true" ></i>
        @endif
        
        {{ $ebook->title }}
         <div class="clearfix"></div>   
        </h2>
        <div class="ebook-statistics m-b-10">
            @if (setting('reviews_enabled'))
                @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
                
                <span class="ebook-review pull-left">
                    ({{ intl_number($ebook->reviews->count()) }} {{ clean(trans('cynoebook::ebook.user_reviews')) }})
                </span>
            @endif
            
            <span class="ebook-view pull-left" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.views')) }}">
                <i class="fa fa-eye"></i> &nbsp; {{ $ebook->viewed}}
            </span>
            @if (setting('enable_ebook_download'))
                @if( $ebook->file_type!='embed_code' )
                <span class="ebook-download ebook-incat pull-left" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
                    <i class="fa fa-download"></i> &nbsp; {{ $ebook->download}}
                </span>
                @endif
            @endif
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        <div class="ebook-byinon m-b-10">
            <span class="ebook-user pull-left">{{clean(trans('cynoebook::ebook.by'))}} 
            @if($ebook->user()->exists())
                <a href="{{ route('user.profile.show',$ebook->user->username) }}">{{ $ebook->user->full_name }}</a>
            @else
                {{ clean(trans('cynoebook::ebook_card.guest')) }}
            @endif
            </span>
            
            <!-- <span class="ebook-on pull-left"> {{clean(trans('cynoebook::ebook.posted_on'))}} <a href="#">{{ $ebook->created_at->toFormattedDateString() }}</a></span> -->
            <div class="clearfix"></div> 
            <span class="ebook-incat pull-left ">
                {{clean(trans('cynoebook::ebook.in_category'))}} -  
                @foreach ($ebook->categories as $category)
                    <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                        {{ $category->name }}{{ (!$loop->last) ? ', ' : ''}}
                    </a>
                @endforeach
            </span>
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        <div class="ebook-other m-b-10">
        
            <span class="ebook-authors show"> 
                <label>{{ trans('cynoebook::ebook.authors') }}:</label>
                 @foreach ($ebook->authors as $author)
                    @if($author->is_verified && $author->is_active )
                        <a href="{{ route('authors.show', $author->slug)}}">{{ $author->name }}</a>{{ (!$loop->last) ? ', ' : ''}}
                    @else
                        {{ $author->name }}{{ (!$loop->last) ? ', ' : ''}}
                    @endif
                    
                @endforeach
            </span>
        
            @if (! is_null($ebook->isbn))
                <span class="ebook-isbn-number show "> 
                    <label>{{ trans('cynoebook::ebook.isbn_number') }}:</label>
                    {{ $ebook->isbn }}
                </span>
            @endif
        
            @if (! is_null($ebook->publisher))
                <span class="ebook-publisher pull-left "> 
                    <label>{{ trans('cynoebook::ebook.published_by') }}:</label>
                    {{ $ebook->publisher }}
                </span>
            @endif
        
            @if (! is_null($ebook->publication_year))
            <span class="ebook-publication-year pull-left "> 
                <label>{{ trans('cynoebook::ebook.in_year') }}:</label>
                {{ $ebook->publication_year }}
            </span>
            @endif
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        @if (! is_null($ebook->short_description))
            <div class="ebook-brief">{{ $ebook->short_description }}</div>
            <div class="clearfix"></div>
        @endif 
        <div class="ebook-action m-b-10"> 
            
            <p class="alert alert-success">
                Thanks for your request
            </p>
            <h5 class="alert alert-info">Attached below is complete Guideline/Reference material</h5>
            <!-- Ensure main ebook is available for purchase before displaying download button -->
            @if ( $ebook->hasMainBookFile() )
                 <!-- TODO -->
                 <!-- use this to deliver main ebook after purchase -->
                 <!-- getMainBookFileAttribute() has all details about the flle for purchase -->
                 
                @if($ebook->main_file_type=='upload' )
                    <a class="btn btn-primary btn-sm btn-green" href="{{ route('ebooks.purchased.download',[$ebook->slug,id_encode($ebook->main_book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.full-download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> <span>Download File</span></a>
                @endif
                @if( $ebook->main_file_type=='external_link')
                    <a class="btn btn-primary btn-sm btn-green" href="{{ route('ebooks.purchased.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> <span>Download File</span></a>
                @endif
            @endif
            <div class="clearfix"></div>
        </div> 
        
    </div>
</div>
@push('scripts')
<script>
    function PrintPDF(elem)
    {
        var objFra = document.getElementsByClassName(elem);
        objFra.contentWindow.focus();
        objFra.contentWindow.print();
    }
    (function () {
        "use strict";
        
        
        $(document).ready(function(){
            @if(report_form_has_error($errors))
                $('body').append('<div class="right-actions-overlay"></div>');
                $("#reportBook").addClass('open');
                $(".right-actions-overlay").show();
            @endif
        }); 
    })();     
    
</script>
@endpush