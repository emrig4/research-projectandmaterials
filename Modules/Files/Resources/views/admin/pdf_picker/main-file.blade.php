<div class="form-group row ">
    <label for="about" class="col-md-4 text-left">
        <h4>{{ $title }}</h4>
    </label>
    <div class="single-image-wrapper col-md-8 p-0">
       
        <div class="single-image image-holder-wrapper pull-left">
            @if (! $file->exists)
                <div class="image-holder placeholder">
                    <i class="fas fa-file-upload"></i>
                </div>
            @else
                <div class="image-holder">
                    <i class="fas fa-file"></i>
                    <button type="button" id="remove-main-pdf" class="btn remove-pdf" data-input-name="{{ $inputName }}"></button>
                    <textarea class="form-control file-display-name" readonly="1">{{ $file->mainbookfile->filename }}</textarea>
                </div>
            @endif
        </div>
        
        <button type="button" class="main-pdf-picker btn btn-default btn-border pull-left" data-input-name="{{ $inputName }}" data-filetype="{{ $fileType }}">
            <i class="fas fa-folder-open mr-2"></i> {{ clean(trans('files::files.browse')) }}
        </button>
        <div class="clearfix"></div>
        <div class="pdf-file-result">
<!--             if ($file->exists)
                {{ Form::text('main_ebook_file', '', $errors, '', ['labelCol' => 0,' readonly'=>true,'style'=>'','value'=>$file->filename,'class'=>'pdf-file-name']) }}
            else
                {{ Form::text('main_ebook_file', '', $errors, '', ['labelCol' => 0,' readonly'=>true,'style'=>'','value'=>'','class'=>'pdf-file-name']) }}
            endif -->

             @if ($file->exists)
                {{ Form::text('main_ebook_file', '', $errors, '', ['labelCol' => 0,' readonly'=>true,'style'=>'', 'value'=>$file->mainbookfile->filename,'class'=>'main-pdf-file-name']) }}
            @else
                {{ Form::text('main_ebook_file', '', $errors, '', ['labelCol' => 0,' readonly'=>true,'style'=>'','value'=>'','class'=>'main-pdf-file-name']) }}
            @endif

        </div>
    </div>
</div>
