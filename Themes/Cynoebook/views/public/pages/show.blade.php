@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_pages') }}"/>
@endpush
@section('title', $page->name)

@push('meta')
    <meta name="title" content="{{ $page->meta->meta_title }}">
    <meta name="keywords" content="{{ implode(',', $page->meta->meta_keywords) }}">
    <meta name="description" content="{{ $page->meta->meta_description }}">
    <meta property="og:title" content="{{ $page->meta->meta_title }}">
    <meta property="og:description" content="{{ $page->meta->meta_description }}">
@endpush

@section('breadcrumb')
    <li class="active">{{ $page->name }}</li>
@endsection

@section('content')
	<section class="content">
        <div class="container">
		 	<div class="section section-padding">{!! $page->body !!}</div>
		</div>
	</section>
@endsection
