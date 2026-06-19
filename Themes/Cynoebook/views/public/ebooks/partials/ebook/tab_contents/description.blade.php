<div id="description" style="padding-top: 20px" class="description tab-pane fade in {{ request()->has('reviews') || review_form_has_error($errors) ? '' : 'active' }}">
    {!! $ebook->description !!}
</div>
