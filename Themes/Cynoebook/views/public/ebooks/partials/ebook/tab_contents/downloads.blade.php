<div id="downloads" style="padding-top: 20px" class=" tab-pane fade in">
	<!-- resource download table -->
    <div class="table-body" style="height: auto;">
        <table class="edu-table-responsive table table-responsive table-hover">
            <tbody>
	            <tr class="heading-content">
	                <td colspan="2" class="left heading-content">File Details</td>
	            </tr>
	            <tr class="table-row">
	                <td class="left col-1">
	                	<!-- get main file links -->
	                	<a href="{{route('ebooks.cart', ['ebook' => $ebook->id])}}" class="btn-clear"><span>Download Full Chapters</span></a>
		            </td>

	                <td class="">
	                	@if( $ebook->price )
	                    	<p>{{ $ebook->currencyCode() }} {{ $ebook->price }}</p>
	                    @else
	                    	<p>	Free</p>
	                    @endif
	                </td>
	            </tr>
	            <tr class="table-row">
	         		<td class="left col-1">                  
	                    @if (setting('enable_ebook_download'))
	                        @if($ebook->file_type=='upload' )
	                        <a class="" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
	                            <i class="bg-green mr25 fa fa-caret-right"></i>
	                			<span>Download Preview</span>
	                		</a>
	                		@endif
	                	@endif

                        @if( $ebook->file_type=='external_link')
                            <a class="btn btn-green" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}" style="margin: 10px"> 
                                <i class="bg-green mr25 fa fa-caret-right"></i>
                    			<span>Download Preview</span>
                            </a>
                        @endif
	    			</td>

	                <td class="">
	                    Free
	                </td>
	            </tr>
            </tbody>
        </table>
    </div>
</div>
