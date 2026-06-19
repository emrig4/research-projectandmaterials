<div class=" text-center">
    @if ($ebook->password=='' &&  $unlock)
    <div class="panel-group " id="ebook-files-preview" role="tablist" aria-multiselectable="true">
        <!--Main File-->
        @php
            $inc=1;
            $addAudiojs=1;
        @endphp
        <!--Files-->
        @if(!empty($availableFiles))
            @foreach($availableFiles as $file)
                <div class="">
                    <div class="panel-heading text-left" role="tab" id="heading-file-{{$inc}}">
                        <h4 class="panel-title" style="overflow-wrap: break-word;">
                            <a role="button">
                            {{ clean(trans('cynoebook::ebook.file')) }}: {{ $file['filename']!='' ? $file['filename'] :  $ebook->title }}
                            </a>
                            @if (setting('enable_ebook_download'))
                                @if( $ebook->file_type=='audio'  )
                                    <a class="btn btn-primary btn-sm pull-right" href="{{ route('ebooks.download',[$ebook->slug,id_encode($file['file']->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i></a>
                                    <div class="clearfix"></div>
                                @endif
                            @endif
                        </h4>
                    </div>
                    <div id="collapse-file-{{$inc}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-file-{{$inc}}">
                        <div class="panel-body">
                            @if($file['viewer']=='embed')
                                {!! $ebook->embed_code !!}
                            @endif
                            @if($file['viewer']=='pdf')
                                <div id="disp-pdf-{{$inc}}">
                                    @if($file['type']!='external')

                                        <!-- disable this due to cors issues from pccloud -->
                                        <!-- I will simply treat all previews as external pdfs  -->

                                        <!-- <iframe src="{{ Theme::url('pdfViewer/web/viewer.html?file='.$file['url']) }}" id="ipdf" frameborder="0" style="border:0;width: 100%;height: 500px;"></iframe> -->


                                         @include('public.ebooks.viewer.pdfviewer-custom2', ['ebook'=>$ebook,'url'=>$file['url'],'type'=>$file['type'],'num'=>$inc])
                                    @else                   
                                        @include('public.ebooks.viewer.pdfviewer-custom2', ['ebook'=>$ebook,'url'=>$file['url'],'type'=>$file['type'],'num'=>$inc])
                                    @endif


                                    <!-- get main file links -->
                                   <div class="mt-50"> 
                                        
                                            @if (setting('enable_ebook_download'))
                                                @if($ebook->file_type=='upload' )
                                                    <a class="" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
                                                        <button class="mt-10 btn btn-green">
                                                            <i class="fa fa-download" aria-hidden="true" ></i>
                                                            <span>preview</span>
                                                        </button>
                                                    </a>
                                                @endif
                                                @if( $ebook->file_type=='external_link')
                                                    <a class="" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"> 
                                                        <button class="mt-10 btn btn-green">
                                                            <i class="fa fa-download" aria-hidden="true" ></i>
                                                            <span>preview</span>
                                                        </button>
                                                    </a>
                                                @endif
                                            @endif

                                        
                                        
                                            <a href="{{route('ebooks.cart', ['ebook' => $ebook->id])}}" class="mt-10 btn btn-green"><span>Download Full Chapters</span></a>
                                       

                                   </div>
                                </div>
                            @endif
                            @if($file['viewer']=='epub')
                                <iframe class="print-file" src="{{ route('ebooks.epubReader',$ebook->slug) }}" id="epub-{{$inc}}" frameborder="0" style="width: 100%;height: 500px;"></iframe>
                            @endif
                            @if($file['viewer']=='audio')
                                @include('public.ebooks.viewer.audio', ['ebook'=>$ebook,'url'=>$file['url'],'filename'=>$file['filename'],'num'=>$inc,'addjs'=>$addAudiojs])
                                @php
                                    $addAudiojs=0;
                                @endphp
                            @endif
                            @if($file['viewer']=='gview')
                                @include('public.ebooks.viewer.gview', ['ebook'=>$ebook,'url'=>$file['url'],'num'=>$inc])
                            @endif
                        </div>
                    </div>
                </div>
                @php
                    $inc++;
                @endphp
            @endforeach
        @endif
    </div>    
   
        
        
    @else
            <button type="submit" class="btn btn-danger btn-lg btn-right-actions"  data-target="#unlockBook" id="btn-unlockBook" ><i class="fa fa-lock"></i> {{ clean(trans('cynoebook::ebook.unlock')) }}</button>
            
            <div class="right-actions" id="unlockBook">
                <div class="title">{{ clean(trans('cynoebook::ebook.password_header')) }}</div>
                <div class="action-content">
                    <div id="action-movefile">
                        <form method="POST" action="{{ route('ebooks.unlock',$ebook->slug) }}" id="ebook-unlock-form" name="ebook-unlock-form">    
                            {{ csrf_field() }}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group row  {{ $errors->has('unlockpassword') ? 'has-error' : '' }}" >
                                    <label for="unlockpassword" class="col-md-12 text-left">{{ clean(trans('cynoebook::ebook.password')) }}</label>
                                    <div class="col-md-12 p-0">
                                    <input type="password" class="form-control" name="unlockpassword" required>
                                    @if($errors->has('unlockpassword'))
                                        <span class="error-message text-left">{{ clean($errors->first('unlockpassword')) }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-primary btn-lg" data-loading>{{ clean(trans('cynoebook::ebook.unlock')) }}</button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
                <div class="action-toggle">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>

                
    @endif
</div>

@push('scripts')
    
    <script>
        (function () {
            "use strict";
            
            $(document).ready(function() {
                /* $('.btin-print').on("click", function () {
                  $('.print-file').printThis({canvas:true});
                }); */
                @if ($ebook->password!='' &&  !$unlock)
                    $('body').append('<div class="right-actions-overlay"></div>');
                    $("#unlockBook").addClass('open');
                    $(".right-actions-overlay").show();
                @endif
                
                $("#ebook-unlock-form").bind("keypress", function(e) {
                    if (e.keyCode == 13) {
                        return false;
                    }
                });
                
            });
            
        })();  
    </script>

@endpush


