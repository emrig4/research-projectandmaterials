@php

use Modules\Setting\Entities\Setting as Settings;
$aggregator = Settings::get('payment_aggregator');
$title = $btnText;
$class = $btnClass;
@endphp

@if($aggregator == 'rave')
   @include('public.ebooks.partials.ravebuy', ['title' => $title, 'class' => $class])
@elseif($aggregator == 'paystack')
     @include('public.ebooks.partials.paystackbuy', ['title' => $title, 'class' => $class] )
@endif