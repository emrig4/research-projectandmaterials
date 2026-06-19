@if ( $ebook->hasMainBookFile() && $ebook->price )
    @include('public.ebooks.partials.buy', ['ebook' => $ebook, 'btnText' => $btnText ? $btnText : 'Full Chapters', 'btnClass' => $class ? $class : 'btn btn-green' ])
@else
    <!-- free downloads -->
    @if($ebook->main_file_type=='upload' )
        <a class="{{ $class ? $class : 'btn btn-green' }}" href="{{ route('ebooks.purchased.download',[$ebook->slug,id_encode($ebook->main_book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.full-download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> <span>Download File</span></a>
    @endif
    @if( $ebook->main_file_type=='external_link')
        <a class="{{ $class ? $class : 'btn btn-green' }}" href="{{ route('ebooks.purchased.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> <span>Download File</span></a>
    @endif      
@endif