@extends('public.layout')

@section('title', $ebook->name)

@push('meta')
    <meta name="title" content="{{ $ebook->meta->meta_title }}">
    <meta name="keywords" content="{{ implode(',', $ebook->meta->meta_keywords) }}">
    <meta name="description" content="{{ $ebook->meta->meta_description }}">
    <meta property="image" content="{{ $ebook->bookCover->path }}">
    <meta property="og:title" content="{{ $ebook->meta->meta_title }}">
    <meta property="og:description" content="{{ $ebook->meta->meta_description }}">
    <meta property="og:image" content="{{ $ebook->bookCover->path }}">
@endpush

@section('content')
    
    <!-- page header and breadcrum -->
    <div class="section background-opacity page-title set-height-top" style="background: url('{{ v(Theme::url('public/images/cart/checkout_bg.jpg'))  }}'); background-size: contain;">
        <div class="container">
            <div class="page-title-wrapper">
                <h2 class="captions">
                    Cart
                </h2>
                <ol class="breadcrumb">
                    <li class="active">{{ $ebook->title }}</li>
                </ol>
            </div>
        </div>
    </div>


    @if (setting('cynoebook_ad1_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
    @endif 
    <div class="section section-padding courses-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="course-title">GET COMPLETE CHAPTERS</h4>
                    <h2 class="course-title">{{ $ebook->title }}</h2>
                    <div class="course-info info">
                        <div class="author item"><a href="#">
                            @if($ebook->user()->exists())
                                <a href="{{ route('user.profile.show',$ebook->user->username) }}">
                                    <!-- <span>Uploaded By&nbsp;</span><span> {{ $ebook->user->full_name }} </span></a> -->
                                </a>
                            @else
                                <!-- <span>By&nbsp;</span><span> {{ clean(trans('cynoebook::ebook_card.guest')) }}</span></a> -->
                               
                            @endif
                        </div>
                        @foreach ($ebook->categories as $category)
                            <div class="date-time item">
                                <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                                    {{ $category->name }}{{ (!$loop->last) ? ', ' : ''}}
                                </a>
                            </div>
                        @endforeach
                        <div class="date-time item">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                     <h4>YOU HAVE JUST A MINUTE TO ACCESS COMPLETE CHAPTERS</h3> 
           <i class="bg-green mr25 ">ALL listed project topics on our website are available and complete materials in typed format from chapter 1-5, which are well supervised and approved by lecturers who are intellectual in their various fields of discipline, documented to assist you with complete, quality and well organized researched project topics and materials. You can Access or Download complete chapters of your specific topics with 2,500 for Nigerian student, 40 Cedis for Ghana students, you can make Payment via ATM Transfer, Bank Deposit, USSD Transfer, Internet Mobile Banking OR Online Payment Channels for instant access/download to complete chapters.</i><br><br/>
           
           
            
                    <div class="section progress-bars section-padding" style="padding: 3px 0;"></div>
                </div>


                <div class="col-md-12 mt-50">
                    <div style="overflow-x: scroll;" class="col-md-6">
                        <h3>1. Bank Transfers</h3>
                        <table  class="edu-table-responsive table table-responsive table-hover" cellpadding="5">
                            <thead class="" >
                                <tr class="left heading-content" style="text-align:center; background: #607d8b">
                                    <th style="" class="text-center" >BANK LOGO</th>
                                    <th style="width:30%" class="text-center">ACCOUNT NAME</th>
                                    <th style="width:10%" class="text-center">ACCOUNT NO.</th>
                                    <th style="width:20%" class="text-center">BANK</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center"> 
                                <tr>
                                    <td class="text-center">
                                        <img class="img-thumbnail" src="{{ v(Theme::url('public/images/cart/payment_banner_diamond.jpg')) }}" width="100%">
                                    </td>

                                    <td class="text-center"><b>EMRI SOLUTION</b></td>
                                    <td class="text-center"><b>0090067333</b></td>
                                    <td class="text-center">DIAMOND BANK</td>

                    
                        
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <img class="img-thumbnail" src="{{ v(Theme::url('public/images/cart/payment_banner_ecobank.png')) }}" width="100%">
                                    </td>
                                    <td class="text-center"><b>EMRI SOLUTION</b></td>
                                    <td class="text-center"><b>1340005839</b></td>
                                    <td class="text-center">ECOBANK</td>
                                 </tr>
                                <tr>
                                    <td class="text-center">
                                        <img class="img-thumbnail" src="{{ v(Theme::url('public/images/cart/payment_banner_zenith.png')) }}" width="100%">
                                    </td>
                                    <td class="text-center"><b>XXXX</b></td>
                                    <td class="text-center"><b>XXXXXXXXXX</b></td>
                                    <td class="text-center">ZENITH BANK</td>
                                </tr>
                                
                                <tr>
                                <td class="text-center">
                                    <img class="img-thumbnail" src="{{ v(Theme::url('public/images/cart/payment_banner_stanbic_ibtc.jpg')) }}" width="100%">
                                </td>
                                    <td><b>XXXXXX</b></td>
                                    <td><b> XXXXXXXXXXX</b></td>
                                    <td>STANBIC IBTC BANK</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <img class="img-thumbnail" src="{{ v(Theme::url('public/images/cart/payment_banner_gtb.jpg')) }}" width="100%">
                                    </td>
                                    <td class="text-center"><b>XXXXXX</b></td>
                                    <td class="text-center"><b>XXXXXXXXXX</b></td>
                                    <td class="text-center">GUARANTY TRUST BANK</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 col-sm-12" style="overflow: hidden;">
                        <h3>2. Online Payment/WebPay</h3>
                        <div class="panel panel-body panel-info text-info text-center">
                            <h4><i class="fa fa-credit-card"></i> WE ACCEPT ONLINE PAYMENTS</h4>
                            <img src="{{ v(Theme::url('public/images/cart/secured_by_paystack.png')) }}" class="img img-responsive img-rounded">
                            <hr>
                            <h4><i class="fa fa-credit-card"></i> WE ALSO ACCEPT INTERNATIONAL PAYMENTS...</h4>
                            <img src="{{ v(Theme::url('public/images/cart/secured_by_flutterwave.png')) }}" class="img img-responsive img-rounded" style="margin: 0px auto">

                            @include('public.ebooks.partials.get_main_file', ['ebook' => $ebook, 'class' => 'btn btn-green', 'btnText' => 'Proceed to Online Payment' ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9  sidebar layout-left">
                    <!-- resource details table -->
                    <div class="table-body" style="height: auto;">
                        <table class="edu-table-responsive table table-responsive table-hover">
                            <tbody>
                            <tr class="heading-content">
                                <td colspan="2" class="left heading-content">
                                    <h3>Offline Payment Instructions</h3>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">1</i>
                                    <span style="font-size: 16px; font-weight: 700">Full Name</span></a>
                                </td>
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">2</i>
                                    <span style="font-size: 16px; font-weight: 700">Phone Number</span></a>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">3</i>
                                    <span style="font-size: 16px; font-weight: 700">Email Address</span></a>
                                </td>
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">4</i>
                                    <span style="font-size: 16px; font-weight: 700">Amount Paid</span></a>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">5</i>
                                    <span style="font-size: 16px; font-weight: 700">Project Title</span></a>
                                </td>

                                <td class="left col-1"><a href="#">
                                    <i class="bg-green mr25 ">6</i>
                                    <span style="font-size: 16px; font-weight: 700">Transaction Date</span></a>
                                </td>
                            </tr>

                            <tr class="heading-content">
                                <td colspan="2" class="left heading-content">
                                    <span>
                                         Send the above details to our email; info@projectandmaterials.com or to our support phone number; +234 9038349959. As soon as details are sent and payment is confirmed, your project will be delivered to you within minutes.
                                    </span>
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-3  layout-right">
                     @include('public.ebooks.partials.ebook.images')
                    <!-- include('public.ebooks.partials.ebook.details') -->

                    <div class="table-header">
                        <table class="">
                            <thead>
                            <tr class="heading-table mb-50 " style="display: block;">
                                <th class="right">
                                    @if (setting('enable_ebook_download'))
                                        @if($ebook->file_type=='upload' )
                                            <a class="" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
                                                <button class="btn btn-green">
                                                    <i class="fa fa-download" aria-hidden="true" ></i>
                                                    <span>Download preview</span>
                                                </button>
                                            </a>
                                        @endif
                                        @if( $ebook->file_type=='external_link')
                                            <a class="" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"> 
                                                <button class="btn btn-green">
                                                    <i class="fa fa-download" aria-hidden="true" ></i>
                                                    <span>Download preview</span>
                                                </button>
                                            </a>
                                        @endif
                                    @endif
                                </th> 
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
@endsection
