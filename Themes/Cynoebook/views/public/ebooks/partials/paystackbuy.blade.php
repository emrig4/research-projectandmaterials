<!-- Paystack Button - For logged in users, direct purchase --> 
@if( auth()->check() ) 
    <!-- Meta Payload -->
    @php
        
        $array = [
            ['metaname' => 'ebook_id', 'metavalue' => $ebook->id ],
            ['metaname' => 'main_file_type', 'metavalue' => $ebook->main_file_type],
            ['metaname' => 'main_ebook_file', 'metavalue' => $ebook->main_book_file],
            ['metaname' => 'ebook_price', 'metavalue' => $ebook->price],
            ['metaname' => 'ebook_title', 'metavalue' => $ebook->title],
            ['metaname' => 'customer_type', 'metavalue' => 'user'],
            ['metaname' => 'customer_firstname', 'metavalue' => auth()->user()->first_name ],
            ['metaname' => 'customer_lastname', 'metavalue' => auth()->user()->last_name ],
            ['metaname' => 'user_id', 'metavalue' => auth()->user()->id ],
            ['metaname' => 'ebook_price_currency', 'metavalue' => $ebook->currencyCode() ],
        ];
    @endphp
      
    <div class="">
        <form class="cart-plus-minus" role="form" method="POST" action="{{ route('ebooks.buy.paystack') }}" id="paymentForm" >
            <div class="">
                <input type="hidden" name="amount" value="{{ $ebook->baseValue() }}" />
                <input type="hidden" name="country" value="NG" /> 
                <input type="hidden" name="currency" value="{{ $ebook->currencyCode() }}" />
                <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
                <input type="hidden" name="metadata" value="{{ json_encode($array) }}" >
                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
                <input type="hidden" name="callback_url" value="{{ route('paystack.callback') }}">
                <input type="hidden" name="phone" value="" /> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ csrf_field() }}
            </div>

            <!-- <button type="button" class="btn btn-default btn-green btn-lg">{{ $ebook->currencyCode() }} {{ $ebook->price }}</button> -->
            <button  class="{{ $btnClass }}" type="submit" value="Pay Now!">
                <i class="bg-green mr25 fa fa-download" aria-hidden="true" ></i>
                <span>{{ $title ? $title : 'Full Chapters' }}</span>
            </button>

        </form>
    </div>
@endif



<!-- Paystack Modal - for guest, need to collect additional information -->
@if( !auth()->check() )
     @php
        
        $array = [
            ['metaname' => 'ebook_id', 'metavalue' => $ebook->id ],
            ['metaname' => 'main_file_type', 'metavalue' => $ebook->main_file_type],
            ['metaname' => 'main_ebook_file', 'metavalue' => $ebook->main_book_file],
            ['metaname' => 'ebook_price', 'metavalue' => $ebook->price ],
            ['metaname' => 'ebook_title', 'metavalue' => $ebook->title],
            ['metaname' => 'customer_type', 'metavalue' => 'guest'],
            ['metaname' => 'ebook_price_currency', 'metavalue' => $ebook->currencyCode() ],
        ];
    @endphp


    <button class="{{ $btnClass }}" data-toggle="modal" data-target="#paystackDonateModal">
        <i class="bg-green mr25 fa fa-download" aria-hidden="true" ></i>
        <span>{{ $title ? $title : 'Full Chapters' }}</span>
    </button>

    <!-- Pay Modals -->

     <!-- Paystack Modal -->
        <div class="modal fade" id="paystackDonateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="cart-plus-minus" role="form" method="POST" action="{{ route('ebooks.buy.paystack') }}" id="paymentForm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title alert" id="staticBackdropLabel">Please enter your details</h5>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2 col-md-6"  style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="First Name" style="font-size: 14px; border-radius: 0px" type="text" name="first_name" value="">
                                </div>

                                 <div class="mb-2 col-md-6"  style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Last Name" style="font-size: 14px; border-radius: 0px" type="text" name="last_name" value="">
                                </div>

                                <div class="mb-2 col-md-6" style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Email" style="font-size: 14px; border-radius: 0px" type="text" name="email" value="">
                                </div>

                                <div class="mb-2 col-md-6" style="margin-bottom: 10px">
                                    <input class="form-control" required placeholder="Phone" style="font-size: 14px; border-radius: 0px" type="text" name="phone" id="phone" value="">
                                </div>
                                <!-- <input type="hidden" name="orderID" value="345"> -->
                                <input type="hidden" name="amount" value="{{ $ebook->baseValue() }}"> {{-- required in kobo --}}
                                <!-- <input type="hidden" name="quantity" value="3"> -->
                                <input type="hidden" name="currency" value="{{ $ebook->currencyCode() }}">
                                <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 

                                <input type="hidden" name="callback_url" value="{{ route('paystack.callback') }}">

                                {{-- required --}}
                                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                           
                                {{ csrf_field() }}
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                        
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