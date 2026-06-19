{{ Form::text('paystack_public_key', 'Public key', $errors, $settings, ['required' => true]) }}
{{ Form::password('paystack_secret_key', 'Secret Key', $errors, $settings, ['required' => true]) }}

