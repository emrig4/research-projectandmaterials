@php
	$storage = [
		'' => 'None',
		'default' => 'Default',
		's3' => 'S3',
		'pcloud' => 'pCloud Storage'
	]
@endphp

<!-- airon add currency -->
{{ Form::select('storage_location', 'Storage Location', $errors, $storage, $settings, ['class' => 'select2']) }}
