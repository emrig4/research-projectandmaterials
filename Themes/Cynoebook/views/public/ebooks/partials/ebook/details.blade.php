<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
    <div class="ebook-details">
        {!! $ebook->description !!}
         <div class="clearfix"></div>   

        @if (! is_null($ebook->short_description))
            <div class="ebook-brief">{{ $ebook->short_description }}</div>
            <div class="clearfix"></div>
        @endif 
        
        <div class="ebook-action m-b-10"> 
           <div class="pull-left" style="padding: 10px">
                <!-- Ensure main ebook is available for purchase before displaying buy button -->
                @if ( $ebook->hasMainBookFile() )
                    @include('public.ebooks.partials.buy', ['ebook' => $ebook])
                @endif
           </div>

            <div class=""  style="padding: 10px">
                
                <span class="pull-left" style="margin: 0px 10px;">
                    
                    @if($ebook->isFavorite())
                        <form method="POST" action="{{ route('account.favorite.destroy',$ebook) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">   
                        
                            <button type="submit" class="btn btn-favorite btn-primary btn-lg" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook_card.remove_from_favorite')) }}">
                            <i class="fa fa-heart" aria-hidden="true"></i> Unlike
                            </button>
                        </form>
                    @else   
                        <form method="POST" action="{{ route('favorite.store') }}">
                            {{ csrf_field() }}
                                
                            <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                <button type="submit" class="btn btn-favorite btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook_card.add_to_favorite')) }}">
                                <i class="fa fa-heart-o" aria-hidden="true"></i> Like
                            </button>
                        </form>
                    @endif  
                </span>
                
            
                @if (setting('enable_ebook_report'))
                    @auth
                    <button type="button" id="btn-reportBook" class="btn btn-primary btn-sm btn-right-actions"  data-target="#reportBook" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.report')) }}"><i class="fa fa-flag" aria-hidden="true" ></i> Report</button>
                    @include('public.ebooks.partials.ebook.report.report')
                    @endauth
                @endif
            
                
                @if ($ebook->password=='' &&  $unlock)
                    @if (setting('enable_ebook_print_dis'))
                        <button type="button" class="btn btn-primary btn-sm btin-print" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.print')) }}"><i class="fa fa-print" aria-hidden="true" ></i></button>
                    @endif
                    @if (setting('enable_ebook_download'))
                        @if($ebook->file_type=='upload' )
                            <a class="btn btn-primary btn-sm" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"> <i class="fa fa-download" aria-hidden="true" ></i> Download preview</a>
                        @endif
                        @if( $ebook->file_type=='external_link')
                            <a class="btn btn-primary btn-sm" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}" style="margin: 10px"> <i class="fa fa-download" aria-hidden="true" > </i> Download preview</a>
                        @endif
                    @endif
                @endif
                @if(auth()->user())
                    @if ($ebook->user_id==auth()->user()->id)
                        <a href="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                            
                        <a href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    @endif
                @endif
                
            </div>
            <div class="clearfix"></div>
            @if($ebook->userHasPurchased() )
                <p class="alert alert-warning">Please note that you have already purchased this resource - <a href="{{ route('account.dashboard.index') }}">Goto</a> </p>
            @endif
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