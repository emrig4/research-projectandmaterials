@php
  $programs = ['NCE/ND EQUIVALENT', 'BED/BSc/HND', 'MSC EQUIVALENT', 'PHD EQUIVALENT'];
@endphp
<div class="modals">
    <div class="modal__container">
      <div class="modal__featured">
        <button type="button" class="button--transparent button--close" onclick="window.location='{{route('services.index')}}' ">
          <svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32">
            <g><path fill="#ffffff" d="M1.293,15.293L11,5.586L12.414,7l-8,8H31v2H4.414l8,8L11,26.414l-9.707-9.707 C0.902,16.316,0.902,15.684,1.293,15.293z"></path> </g></svg>
          <span class="visuallyhidden">Return to Product Page</span>
        </button>
        <div class="modal__circle"></div>
      </div>
      
      <div class="modal__content">
        <h3 class="pb-50">Service Request Form</h3>
        <form id="request__form" method="POST" action="{{ route('servicerequests.store') }}">
          @csrf
          <ul class="form-list">
            <li class="form-list__row">
              <label>Name</label>
              <input type="text" name="contact_name" required="" />
            </li>
            <li class="form-list__row">
              <label>Contact Email</label>
              <input type="email" name="contact_email" required="" />
            </li>
            <li class="form-list__row">
              <label>Contact Phone</label>
              <input type="text" name="contact_phone"  />
            </li>
            <li class="form-list__row">
              <label>Program Type</label>
              <input type="text" required name="program_type" list="program-list">
              <datalist id="program-list">
                  @foreach($programs as $program)
                      <option value="{{$program}}">{{$program}}</option>
                  @endforeach
              </datalist>
            </li>
            <li class="form-list__row">
              <label>Subject</label>
              <input type="text" value="{{$service->title}}" name="subject"  />
            </li>
            <li class="form-list__row">
              <label>Request Details</label>
              <textarea rows="5" class="" required="" name="message"></textarea>
            </li>
            <li class="form-list__row form-list__row--inline">
              <div>
                <label>Due Date</label>
                <div class="form-list__input-inline">
                    <input type="text" name="dd_day" placeholder="DD"  minlength="2" maxlength="2" />
                    <input type="text" name="dd_month" placeholder="MM"   minlength="2" maxlength="2" />
                    <input type="number" name="dd_year" placeholder="YYYY"   minlength="4" maxlength="4" />
                </div>
              </div>
            </li>
           <!--  <li class="form-list__row form-list__row--agree">
              <label>
                <input type="checkbox" name="save_cc" checked="checked">
                Save my card for future purchases
              </label>
            </li> -->
            <li class="form-list__row clearfix" style="position: relative; right: 40px">
                <!-- captcha -->    
              {!! app('captcha')->display() !!}

              @if($errors->has('g-recaptcha-response'))
                  <span class="error-message">{{ clean($errors->first('g-recaptcha-response')) }}</span>
              @endif

            </li>

            <li>
              <input type="hidden" name="service_id" value="{{ $service->id }}">
              <button type="submit" class="btn btn-green"><span>Make Request</span></button>
            </li>
          </ul>
        </form>
      </div> 
      <!-- END: .modal__content -->
    </div>
</div>