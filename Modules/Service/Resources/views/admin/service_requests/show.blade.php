@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Service Requests')

    <li class="nav-item">{{$serviceRequest->subject}}</li>
@endcomponent

@push('styles')
    <style type="text/css">
        @media (max-width: 767px){
            .responsive-table .col {
                display: block; 
                padding: 10px 0;
            }
        }

        .responsive-table .title {
            background-color: #eaeaea;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            padding: 6px 0;
        }
    </style>
@endpush
@section('content')
    <section class="">

        <div class="col-md-12 pb-50"> <hr></div>
        <div class="container">
            <div class="col-md-12 clearfix">

                <div class="pull-right">
                    <button class="btn btn-default" data-toggle="modal" data-target="#requestSettings">SETTINGS</button>
                </div>
                <div class="pull-right">
                    <form method="post" action="{{ route('admin.servicerequests.destroy', ['id' => $serviceRequest->id]) }}" >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">
                            <i class="bg-green mr25 fa fa-trash "></i>
                            <span>  Delete</span>
                        </button>
                    </form>
                </div>
           </div>

          <div class="row mt-20">
              <div class="container">
                  <ul class="responsive-table">
                    <li  class="table-row" style="min-height: 300px">
                        <div class="col">
                            <h3 class="title" >Message:</h3>
                            <p>{{ $serviceRequest->message }}</p>
                            <hr>

                            <p class="title">Service Requested:</p>
                            {{ $serviceRequest->service->title }}
                            <hr>

                             <p class="title" >Due date:</p>
                            {{ $serviceRequest->dd_day . '-' . $serviceRequest->dd_month . '-' . $serviceRequest->dd_year }}
                            <hr>
                            <p class="title" >Program Type:</p>
                            {{ $serviceRequest->program_type }}
                        </div>
                    </li>
                    <li class="table-header">
                        <div class="col col-2"> Name</div>
                        <div class="col col-2"> Email</div>
                        <div class="col col-2">Subject</div>
                        <div class="col col-2">Status</div>
                        <div class="col col-2">Date</div>
                        <div class="col col-2">Program Type</div>
                    </li>
                    <li class="table-row">
                        <div class="col col-2" data-label="Customer Name">{{$serviceRequest->contact_name}}</div>
                        <div class="col col-2" data-label="Customer Email">{{$serviceRequest->contact_email}}</div>
                        <div class="col col-2" data-label="Subject">{{$serviceRequest->subject}}</div>
                        <div class="col col-2" data-label="Status">{{$serviceRequest->status}}</div>
                        <div class="col col-2" data-label="Date">{{$serviceRequest->created_at}}</div>
                        <div class="col col-2" data-label="Program Type">{{$serviceRequest->program_type}}</div>
                    </li>

                    <li  class="table-row" style="min-height: 200px">
                        <div class="col">
                            <h3 class="title" >Admin Note:</h3>
                            <p>{{ $serviceRequest->admin_note }}</p>
                        </div>
                    </li>
                  </ul>
                </div>
          </div>
        </div>
    </section>

<!-- settings modal -->
     <div class="modal fade" id="requestSettings" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form   method="POST" action="{{ route('admin.servicerequests.update', ['id' => $serviceRequest->id ]) }}"  >
                    @csrf
                    @method('patch')
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-2 " >
                                        <label class="label-for-status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option>Status</option>
                                            <option {{($serviceRequest->status == 'pending') ? 'selected' : ''}} value="pending">Pending</option>
                                            <option {{($serviceRequest->status == 'declined') ? 'selected' : ''}} value="declined">Declined</option>
                                            <option {{($serviceRequest->status == 'completed') ? 'selected' : ''}} value="completed">Completed</option>
                                        </select>
                                    </div>

                                     <div class="mb-2 " >
                                        <label class="label-for-status">Add Notes</label>
                                        <textarea class="form-control" rows="4" id="admin_note" name="admin_note"> {{ old('admin_note', $serviceRequest->admin_note) }}</textarea>
                                    </div>

                                    <div class="mb-2 ">
                                        <label class="label-for-active">Is Active</label>
                                        <input class="form-control" {{($serviceRequest->is_active) ? 'checked' : ''}}   type="checkbox" name="is_active" value="1">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal-footer">
                            
                            <button class="btn btn-default btn-green  btn-lg" type="submit" value="Pay Now!">
                                <span>  Update</span>
                            </button>

                            <button class="btn btn-default btn-lg" data-dismiss="modal">
                                <i class="bg-green mr25 fa fa-cancel fa-lg"></i>
                                <span>  Close</span>
                            </button>
                        </div>
                    </div>
                </form>
        </div>
@endsection


