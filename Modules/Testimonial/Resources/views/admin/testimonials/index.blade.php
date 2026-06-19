@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Testimonials')

    <li class="nav-item">testimonials</li>
@endcomponent

@section('content')
    <div class="content container-fluid">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-solid">
                    <div class="card-header with-border">
                        <h3 class="pull-left card-title">
                            <span><i class="fa fa-table"></i></span>
                            <span>List All Testimonials</span>
                        </h3>

                        <a href="{{route('admin.testimonials.create')}}" class="pull-right btn btn-primary btn-round">ADD NEW</a>
                    </div>

                    <div class="card-body">
                        <table id=" tbl-list" data-server="false" class="dt-table table table-striped table-responsive table-bordered">
                            <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Company</th>
                                <th width="30%">Comment</th>
                                <th>Enabled</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td class="">
                                        <img style="width: 40px; height: 40px" class="avatar-img rounded-circle" src="{{ $testimonial->avatar() }}">
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->location }}</td>
                                    <td>{{ $testimonial->company }}</td>
                                    <td>{{ $testimonial->comment }}</td>
                                    <td>{{ $testimonial->is_enabled ? 'Yes' : 'No' }}</td>
                                    
                                    <td class="">
                                        <div class="btn-group">
                                            <button
                                             data-id="{{$testimonial->id}}" class="btn btn-sm btn-link  viewFaqButton" >
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <a
                                            href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                              class="btn btn-sm btn-link  my-1" >
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button
                                             data-id="{{$testimonial->id}}" class="btn btn-sm btn-link  deleteFaqButton" >
                                                <i class="fa fa-trash"></i>
                                            </button> 
                                        </div>
                                    </td>   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="col-lg-12 d-flex flex-row-reverse mb-2 mt-3">
                        {{$testimonials->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VIEW TESTIMONIAL MODAL -->
        <div class="row">
            <!-- Modal for Single FAQ view -->
            <div class="modal fade" id="viewFAQModal" tabindex="-1" role="dialog" aria-labelledby="viewFAQModal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">FAQ</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="question bg-dark text-light p-2 my-2">
                    </div>
                    <hr/>
                    <div class="answer">
                            
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </div>


        <!-- Delete Testimonial -->
        <div class="row">
            <!-- Delete Testimonial Button trigger modal -->
            <div class="modal fade" id="deleteFAQModal" tabindex="-1" role="dialog" aria-labelledby="deleteFAQModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            Are you sure about this?
                      </div>
                      <div class="modal-footer">
                        <form class="" id="delete-testimonial" name="delete-testimonial" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="confirm">Delete</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // View
            $(".viewFaqButton").click(function(){
                //alert($(this).attr('data-id'));
                $.ajax({
                    url: ' /admin/faqs/' +  $(this).attr('data-id'),
                    type: 'GET',
                     success: function(data)
                     {   
                        $('#viewFAQModal').find('.question').html(data.faq.question);
                        $('#viewFAQModal').find('.answer').html(data.faq.answer);                  
                        $('#viewFAQModal').modal('show'); 

                        // console.log(data);
                    },
                    error: function(error){
                        // console.log(error);
                    }
                });    
            });

            

            // Delete
            $('.deleteFaqButton').click(function(e){
                e.preventDefault();
                var testimonialId = $(this).attr('data-id');
                $('#deleteFAQModal').modal('show');

                $('button#confirm').click(function(){
                    $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('#deleteFAQModal').find('input[name$="_token"]').attr('value')
                        },

                        url: ' /admin/testimonials/' +  testimonialId,
                        type: 'DELETE',
                         success: function(data)
                         {   
                            $('#deleteFAQModal').find('div.modal-body').html(data.message);
                            setTimeout(function(){
                                $('#deleteFAQModal').modal('hide');
                                window.location.reload();
                            }, 1000);
                        },

                        error: function(error){
                            console.log(error);
                        }
                    });  
                });

            });

            

        });

    </script>
@endpush