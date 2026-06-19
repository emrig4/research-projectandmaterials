
{{ Form::text('rave_public_key', 'Public Key', $errors, $settings, ['required' => true]) }}

{{ Form::password('rave_secret_key', 'Secret Key', $errors, $settings, ['required' => true]) }}

{{ Form::text('rave_title', 'Title', $errors, $settings, ['required' => true]) }}

{{ Form::text('rave_environment', 'Environment', $errors, $settings, ['required' => true]) }}

{{ Form::text('rave_logo', 'Logo', $errors, $settings, ['required' => true]) }}

{{ Form::text('rave_prefix', 'Prefix', $errors, $settings, ['required' => true]) }}

{{ Form::text('rave_secret_hash', 'Title', $errors, $settings, ['required' => true]) }}