@php
    $allowedFileTypes=get_allowed_file_types();
    $allowedAudioFileTypes=get_allowed_file_types('audio');
    $allowedFileTypes=implode (",", $allowedFileTypes);
    $allowedAudioFileTypes=implode (",", $allowedAudioFileTypes);
@endphp

@include('files::admin.pdf_picker.book-cover', [
    'title' => trans('ebook::ebooks.form.book_cover'),
    'inputName' => 'files[book_cover]',
    'file' => $ebook->bookcover,
])


<!-- PREVIEW FILE -->
<hr>
<h3>Preview File</h3>
{{ Form::select('file_type', clean(trans('ebook::attributes.file_type')), $errors, clean(trans('ebook::ebooks.form.file_type')), $ebook, ['required' => true]) }}


<!-- External url for preview file -->
<div class="link-field external_link-field {{ old('file_type', $ebook->file_type) !== 'external_link' ? 'd-none' :'' }}">
    {{ Form::text('file_url', trans('ebook::ebooks.form.book_file_external'), $errors, $ebook, ['required' => true]) }}
</div>


<!-- embed preview file -->

<!-- <div class="link-field embed_code-field {{ old('file_type', $ebook->file_type) !== 'embed_code' ? 'd-none' :'' }}" >
   {{ Form::textarea('embed_code', clean(trans('ebook::ebooks.form.embed_code')), $errors, $ebook, ['rows' => 2,'required' => true,'help'=> clean(trans('ebook::ebooks.form.embed_code_help_text'))]) }}

</div> -->

<!-- pdf preview -->
<div class="link-field upload-field {{ old('file_type', $ebook->file_type ?? 'upload') !== 'upload' ? 'd-none' :'' }}">
    @include('files::admin.pdf_picker.single', [
        'title' => trans('ebook::ebooks.form.book_file'),
        'inputName' => 'files[book_file]',
        'file' => $ebook->bookfile,
        'fileType' => $allowedFileTypes,
    ])
</div>

<!-- audio preview file -->
<!-- <div class="link-field audio-field {{ old('file_type', $ebook->file_type) !== 'audio' ? 'd-none' :'' }}">
    include('files::admin.pdf_picker.multiple', [
        'title' => trans('ebook::ebooks.form.audio_book_files'),
        'inputName' => 'files[audio_book_files][]',
        'files' => $ebook->audioBookFiles,
        'fileType' => $allowedAudioFileTypes,
        'inputValidation'=>'audio_files_count'
    ])
    if ( $ebook->audioBookFiles->isNotEmpty())
        {{ Form::text('audio_files', '', $errors, '', [ 'required' => true,' readonly'=>true,'style'=>'display:none;','value'=>'1','class'=>'audio_files_count']) }}
    else
        {{ Form::text('audio_files', '', $errors, '', [ 'required' => true,' readonly'=>true,'style'=>'display:none;','value'=>'','class'=>'audio_files_count']) }}
    endif
</div> -->



<!-- MAIN FILE -->
<hr>
<h3>Main File</h3>
{{ Form::select('main_file_type', clean(trans('ebook::attributes.file_type')), $errors, clean(trans('ebook::ebooks.form.file_type')), $ebook, ['required' => true]) }}


<!-- Main External url -->
<div class="link-field2 external_link-field2 {{ old('file_type', $ebook->file_type) !== 'external_link' ? 'd-none' :'' }}">
    {{ Form::text('main_file_url', trans('ebook::ebooks.form.book_file_external'), $errors, $ebook, ['required' => true]) }}
</div>

<!-- Main PDF FILE -->
<div class="link-field2 upload-field2 {{ old('file_type', $ebook->file_type ?? 'upload') !== 'upload' ? 'd-none' :'' }}">
    @include('files::admin.pdf_picker.main-file', [
        'title' => trans('ebook::ebooks.form.book_file'),

        'inputName' => 'files[main_book_file]',
        'file' => $ebook->bookfile,
        'fileType' => $allowedFileTypes,
    ])
 
</div>


@push('scripts')
    <script>
    (function () {
        "use strict";
            $('#file_type').on('change', (e) => {
                $('.link-field').addClass('d-none');
                $(`.${e.currentTarget.value}-field`).removeClass('d-none');
            });

            $('#main_file_type').on('change', (e) => {
                $('.link-field2').addClass('d-none');
                $(`.${e.currentTarget.value}-field2`).removeClass('d-none');
            });
    })();
    </script>
    <style>
    [data-notify="container"] { z-index: 9999 !important; }
    </style>
@endpush
