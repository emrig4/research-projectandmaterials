@php
	$aggregators = [
		'' => 'None',
		'rave' => 'Flutter Wave',
		'paystack' => 'Paystack'
	]
@endphp

<!-- airon add currency -->
{{ Form::select('payment_aggregator', 'Payment Processor', $errors, $aggregators, $settings, ['class' => 'select2']) }}
