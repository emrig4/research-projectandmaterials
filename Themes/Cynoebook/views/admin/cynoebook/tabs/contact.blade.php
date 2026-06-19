
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.contact')) }}</h4>

{{ Form::text('contact_phone1', 'Contact Phone1', $errors, $settings) }}
{{ Form::text('contact_phone2', 'Contact Phone2', $errors, $settings) }}
{{ Form::text('contact_email', 'Contact Email', $errors, $settings) }}

{{ Form::text('contact_address_line1', 'Contact Address Line 1', $errors, $settings) }}
{{ Form::text('contact_address_line2', 'Contact Address Line 2', $errors, $settings) }}
{{ Form::text('contact_address_line3', 'Contact Address Line 3', $errors, $settings) }}

{{ Form::wysiwyg('translatable[contact_info]', '', $errors, $settings, ['labelCol' => 0]) }}


            
        