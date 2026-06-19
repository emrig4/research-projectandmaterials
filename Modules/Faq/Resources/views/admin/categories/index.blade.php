@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Faqs Categories')

    <li class="nav-item">faqs categories</li>
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
        
        <!-- list categories -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header with-border">
                        <h3 class="pull-left card-title">
                            <span><i class="fa fa-table"></i></span>
                            <span>List FAQ Categories</span>
                        </h3>

                        <a href="{{route('faqs.create')}}" data-toggle="modal" data-target="#creatFAQCategoryModal" class="pull-right btn btn-primary btn-round">ADD CATEGORY</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Questions Count</th>
                                    <th>____</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $category->name }} </td>
                                    <td> {{ count($category->faqs) }} </td>
                                    <td>
                                        <div class="btn-group">
                                            <button
                                             data-id="{{$category->id}}" class="btn btn-sm btn-link" >
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <button
                                             data-id="{{$category->id}}" class="btn btn-sm btn-link editFaqCategoryButton" >
                                                <i class="material-icons">edit</i>
                                            </button>

                                            <button
                                             data-id="{{$category->id}}" class="btn btn-sm btn-link deleteCategoryButton" >
                                                <i class="fa fa-trash"></i>
                                            </button> 
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="row">
            <!-- Create FAQ Category Modal -->
            <div class="modal fade" id="creatFAQCategoryModal" tabindex="-1" role="dialog" aria-labelledby="creatFAQCategoryModal" aria-hidden="true">
                <form class="" name="create-faq" action="{{ route('faqs.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <h1 id="title">TITLE</h1>
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create FAQ Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <!-- Modal for Single FAQ Category edit -->
            <div class="modal fade" id="editFAQCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editFAQCategoryModal" aria-hidden="true">
                <form class="" name="create-faq" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit FAQ Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="category-name" name="name">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="update-category-btn" class="btn btn-primary">Update</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>  

        <div class="row">
            <!-- Delete FAQ Category Button trigger modal -->
            <div class="modal fade" id="deleteFAQModal" tabindex="-1" role="dialog" aria-labelledby="deleteFAQModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete FAQ Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            Are you sure about this?
                      </div>
                      <div class="modal-footer">
                        <form class="" id="create-category" name="create-category" method="POST">
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

            $(".editFaqCategoryButton").click(function(){
                var faqId = $(this).attr('data-id');
                $('.updateFaqButton').data('data-id', faqId);

                $.ajax({
                    url: ' /admin/faqs/categories/' +  $(this).attr('data-id'),
                    type: 'GET',
                     success: function(data)
                     {   
                        $('#editFAQCategoryModal').find('#category-name').val(data.category.name);                 
                        $('#editFAQCategoryModal').modal('show');

                        //console.log(data); 
                    },
                    error: function(error){
                        //console.log(error);
                    }
                });    
                
                $("#update-category-btn").click(function(e){
                    e.preventDefault();

                    var updatedName = $('#editFAQCategoryModal').find('#category-name').val();

                    var updateAlert = $('#editFAQModal').find('div.update-alert');
                    updateAlert.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");
                    $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('#editFAQModal').find('input[name$="_token"]').attr('value')
                          },
                          url: '/admin/faqs/categories/' +  faqId,
                          
                          type: 'PATCH',
                          data: {
                            name: updatedName,
                          },

                         success: function(data)
                         {  
                            updateAlert.html("<p class='text-success text-sm'>Updated successfully</p>");                 
                            $('#editFAQCategoryModal').modal('hide'); 
                            window.location.reload();
                            // console.log(data);
                        },
                        error: function(error){
                            // console.log(error);
                        }
                    });    
                });

            });

            $('.deleteCategoryButton').click(function(e){
                e.preventDefault();
                var faqId = $(this).attr('data-id');
                $('#deleteFAQModal').modal('show');

                $('button#confirm').click(function(){
                    $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('#deleteFAQModal').find('input[name$="_token"]').attr('value')
                        },

                        url: ' /admin/faqs/categories/' +  faqId,
                        type: 'DELETE',
                         success: function(data)
                         {   
                            $('#deleteFAQModal').find('div.modal-body').html('FAQ Category Deleted successfully');
                            setTimeout(function(){
                                $('#deleteFAQModal').modal('hide');
                                window.location.reload();
                            }, 1000);
                        },

                        error: function(error){
                            // console.log(error);
                        }
                    });  
                });

            });

            

        });

    </script>
@endpush