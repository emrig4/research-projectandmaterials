<!-- Flutterwave Button - For logged in users, direct purchase --> 
@if( auth()->check() ) 
    <!-- Meta Payload -->
    @php

        if($ebook->main_file_type === 'upload'){
            $main_book_file = $ebook->main_book_file->filename;
        }else{
            $main_book_file = $ebook->main_book_file;
        }
        
        $array = [
            ['metaname' => 'ebook_id', 'metavalue' => $ebook->id ],
            ['metaname' => 'main_file_type', 'metavalue' => $ebook->main_file_type],
            ['metaname' => 'main_ebook_file', 'metavalue' => $main_book_file],
            ['metaname' => 'ebook_price', 'metavalue' => $ebook->price],
            ['metaname' => 'ebook_title', 'metavalue' => $ebook->title],
            ['metaname' => 'customer_type', 'metavalue' => 'user'],
            ['metaname' => 'user_id', 'metavalue' => auth()->user()->id ],
            ['metaname' => 'ebook_price_currency', 'metavalue' => $ebook->currencyCode() ],
        ];
    @endphp
   
    <div class="">
        <form class="cart-plus-minus" role="form" method="POST" action="{{ route('ebooks.buy.rave') }}" id="paymentForm" >
            <div class="">
                     {{ csrf_field() }}
                    <input type="hidden" name="amount" value="{{ $ebook->price }}" />
                    <input type="hidden" name="payment_method" value="both" />
                    <!-- <input type="hidden" name="description" value="" /> -->
                    <input type="hidden" name="country" value="NG" /> 
                    <input type="hidden" name="currency" value="{{ $ebook->currencyCode() }}" />
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
                     <!-- Replace the value with your customer email -->
                    <input type="hidden" name="firstname" value="{{ auth()->user()->first_name }}" />
                     <!-- Replace the value with your customer firstname -->
                    <input type="hidden" name="lastname" value="{{ auth()->user()->last_name }}" />
                     <!-- Replace the value with your customer lastname -->
                    <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->

                    <input type="hidden" name="phonenumber" value="" /> 
                    <!-- Replace the value with your customer phonenumber -->
                    <!-- <input type="hidden" name="paymentplan" value="" />  -->
                    <!-- Ucomment and Replace the value with the payment plan id --> 
                     
                    <input type="hidden" name="title" value="{{ $ebook->title }}" /> 
                    <!-- Replace the value with your transaction title (Optional, present in .env) -->
            </div>

            <button  class="{{ $btnClass }}" type="submit" value="Pay Now!">
                <i class="bg-green mr25 fa fa-download" aria-hidden="true" ></i>
                <span>{{ $title ? $title : 'Full Chapters' }}</span>
            </button>

        </form>
    </div>
@endif



<!-- Flutterwave Modal - for guest, need to collect additional information -->
@if( !auth()->check() )
     @php

        if($ebook->main_file_type === 'upload'){
            $main_book_file = $ebook->main_book_file->filename;
        }else{
            $main_book_file = $ebook->main_book_file;
        }
        
        $array = [
            ['metaname' => 'ebook_id', 'metavalue' => $ebook->id ],
            ['metaname' => 'main_file_type', 'metavalue' => $ebook->main_file_type],
            ['metaname' => 'main_ebook_file', 'metavalue' => $main_book_file],
            ['metaname' => 'ebook_price', 'metavalue' => $ebook->price],
            ['metaname' => 'ebook_title', 'metavalue' => $ebook->title],
            ['metaname' => 'customer_type', 'metavalue' => 'guest'],
            ['metaname' => 'ebook_price_currency', 'metavalue' => $ebook->currencyCode() ]
        ];
    @endphp

    <button class="{{ $btnClass }}" data-toggle="modal" data-target="#raveBuyModal">
        <i class="bg-green mr25 fa fa-download" aria-hidden="true" ></i>
        <span>{{ $title ? $title : 'Full Chapters' }}</span>
    </button>

    <div class="modal fade" id="raveBuyModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="cart-plus-minus" role="form" method="POST" action="{{ route('ebooks.buy.rave') }}" id="paymentForm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title alert" id="staticBackdropLabel">Please enter your details</h5>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2 col-md-6"  style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="First Name" style="font-size: 14px; border-radius: 0px" type="text" name="firstname" value="">
                                </div>

                                 <div class="mb-2 col-md-6"  style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Last Name" style="font-size: 14px; border-radius: 0px" type="text" name="lastname" value="">
                                </div>

                                <div class="mb-2 col-md-6" style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Email" style="font-size: 14px; border-radius: 0px" type="text" name="email" value="">
                                </div>

                                <div class="mb-2 col-md-6" style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Phone" style="font-size: 14px; border-radius: 0px" type="text" name="phone" id="phonenumber" value="">
                                </div>

                                <input type="hidden" name="amount" value="{{ $ebook->price }}" />
                                <input type="hidden" name="payment_method" value="both" />
                                 <!-- Replace the value with your transaction description -->
                                <input type="hidden" name="country" value="NG" /> 
                                <input type="hidden" name="currency" value="{{ $ebook->currencyCode() }}" />
            
                                <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > 
                                <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
                                 
                                <input type="hidden" name="title" value="{{ $ebook->title }}" /> 
                                <!-- Replace the value with your transaction title (Optional, present in .env) -->
                           
                                {{ csrf_field() }}
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button class="btn btn-default btn-green  btn-lg" type="submit" value="Pay Now!">
                            <span>  Continue</span>
                        </button>
                        <button class="btn btn-default btn-lg" data-dismiss="modal">
                            <i class="bg-green mr25 fa fa-cancel fa-lg"></i>
                            <span>  Cancel</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif