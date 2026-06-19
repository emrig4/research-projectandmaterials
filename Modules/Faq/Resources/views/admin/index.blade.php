@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', 'Faqs')

    <li class="nav-item">faqs</li>
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
							<span>List All Faqs</span>
						</h3>

						<a href="{{route('faqs.create')}}" data-toggle="modal" data-target="#creatFAQModal" class="pull-right btn btn-primary btn-round">ADD NEW</a>
					</div>

					<div class="card-body">
						<table id=" tbl-list" data-server="false" class="dt-table table table-striped table-responsive table-bordered">
							<thead class="text-center">
							<tr>
								<th>S/N</th>
	                            <th>Question</th>
	                            <th>Answer</th>
	                            <th>Category</th>
	                            <th >Statistics</th>
	                            <th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($faqs as $faq)
								<tr>
									<td>{{$loop->iteration}}</td>
	                                <td>{{ $faq->question }}</td>
	                                <td>{!! $faq->answer_summary !!}</td>
	                                <td>{!! $faq->category->name !!}</td>
	                                <td class="">
		                                <div class="btn-group">
		                                    <span title="Total Reads" data-toggle="tooltip" class="btn btn-link"><i class="fa fa-eye"></i> {{ $faq->total_read }}</span>
		                                    <span title="Helpful Yes" data-toggle="tooltip" class=" btn btn-link"><i class="fa fa-thumbs-up"></i> {{ $faq->helpful_yes }}</span>
		                                    <span title="Not Helpful" data-toggle="tooltip" class=" btn btn-link"><i class="fa fa-thumbs-down"></i> {{ $faq->helpful_no }}</span>
		                                </div>
	                                </td>
	                                <td class="">
		                                <div class="btn-group">
		                                	<button
		                                	 data-id="{{$faq->id}}" class="btn btn-sm btn-link  viewFaqButton" >
	                                            <i class="fa fa-eye"></i>
	                                        </button>

	                                        <button
		                                	 data-id="{{$faq->id}}" class="btn btn-sm btn-link  editFaqButton my-1" >
	                                            <i class="material-icons">edit</i>
	                                        </button>

	                                        <button
		                                	 data-id="{{$faq->id}}" class="btn btn-sm btn-link  deleteFaqButton" >
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
                        {{$faqs->links('pagination::bootstrap-4')}}
                        </div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<!-- Create FAQ Modal -->
			<div class="modal fade" id="creatFAQModal" tabindex="-1" role="dialog" aria-labelledby="creatFAQModal" aria-hidden="true">
				<form class="" name="create-faq" action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
				   	@method('POST')
					<div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalCenterTitle">Create FAQ</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					   	<div class="modal-body">
	                        <div class="row">
	                            <label class="col-md-12 col-form-label">{{ __('Question') }}</label>
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                    <textarea name="question" class="form-control" rows="3"></textarea>
	                                </div>
	                                @if ($errors->has('question'))
	                                    <span class="invalid-feedback" style="display: block;" role="alert">
	                                        <strong>{{ $errors->first('question') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-md-12 col-form-label">{{ __('Answer') }}</label>
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                    <textarea name="answer" class="form-control" rows="5" style="max-height: none"></textarea>
	                                </div>
	                                @if ($errors->has('answer'))
	                                    <span class="invalid-feedback" style="display: block;" role="alert">
	                                        <strong>{{ $errors->first('answer') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                    <select class="form-control" name="category_id">
	                                        <option>Select category</option>
	                                        @foreach($categories as $category)
	                                            <option class="form-control" value="{{$category->id}}">{{$category->name}}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                                @if ($errors->has('category_id'))
	                                    <span class="invalid-feedback" style="display: block;" role="alert">
	                                        <strong>{{ $errors->first('category_id') }}</strong>
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


		<div class="row">
			<!-- Modal for Single FAQ edit -->
			<div class="modal fade" id="editFAQModal" tabindex="-1" role="dialog" aria-labelledby="editFAQModal" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-scrollable" role="document">
			    <div class="modal-content">
			    	<form class="" id="create-category" name="create-category" method="POST">
                    @csrf
                    @method('POST')
				      	<div class="modal-header">
					        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit FAQ</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
				      	</div>

				      	<div class="modal-body">
	                        <div class="row">
	                            <label class="col-md-12 col-form-label">{{ __('Question') }}</label>
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                    <textarea name="question" id="question" class="form-control" rows="3"></textarea>
	                                </div>
	                            </div>
	                    	</div>

	                    	<div class="row">
	                            <label class="col-md-12 col-form-label">{{ __('Answer') }}</label>
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                    <textarea name="answer" id="answer" class="form-control" rows="5" style="max-height: none"></textarea>
	                                </div>
	                            </div>
	                    	</div>  


	                    	<div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option class="form-control" id="default-category">Select category</option>
                                        @foreach($categories as $category)
                                            <option class="form-control" value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>  


				      	</div>

				      	<div class="modal-footer">
				      		<div class="pull-left update-alert mx-5"></div>
					        <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Cancel</button>
					        <button type="submit" class="btn btn-primary updateFaqButton" data-id="">Update</button>
				      	</div>
				    </form>
			    </div>
			  </div>
			</div>
		</div>	

		<div class="row">
			<!-- Delete FAQ Button trigger modal -->
			<div class="modal fade" id="deleteFAQModal" tabindex="-1" role="dialog" aria-labelledby="deleteFAQModal" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
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

		  	$(".editFaqButton").click(function(){
		  		var faqId = $(this).attr('data-id');
		  		$('.updateFaqButton').data('data-id', faqId);

		      	$.ajax({
		            url: ' /admin/faqs/' +  $(this).attr('data-id'),
		            type: 'GET',
		             success: function(data)
		             {   
		             	$('#editFAQModal').find('#question').val(data.faq.question);
		             	$('#editFAQModal').find('#answer').val(data.faq.answer);
		             	$('#editFAQModal').find('#default-category').html(data.category.name).val(data.category.id);                  
		             	$('#editFAQModal').modal('show');

		             	//console.log(data); 
		            },
		            error: function(error){
		            	//console.log(error);
		            }
		       	});    
		  		
		  		$(".updateFaqButton").click(function(e){
			  		e.preventDefault();

			  		var updatedQuestion = $('#editFAQModal').find('#question').val();
		            var updatedAnswer = $('#editFAQModal').find('#answer').val(); 
		            var updatedCategory_id = $('#editFAQModal').find('#category_id').val();   

			  		var updateAlert = $('#editFAQModal').find('div.update-alert');
			  		updateAlert.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");
			      	$.ajax({
			            headers: {
		                  'X-CSRF-TOKEN': $('#editFAQModal').find('input[name$="_token"]').attr('value')
		                  },
		                  url: '/admin/faqs/' +  faqId,
		                  
		                  type: 'PATCH',
		                  data: {
		                  	question: updatedQuestion,
		                  	answer: updatedAnswer,
		                  	category_id: updatedCategory_id
		                  },
		                  // contentType: false,
		                  // processData: false,
			             success: function(data)
			             {  
			             	updateAlert.html("<p class='text-success text-sm'>Updated successfully</p>");                 
			             	$('#editFAQModal').find('button#close-modal').html('Close');
			             	//$('#editFAQModal').modal('hide'); 
			             	window.location.reload();
			            },
			            error: function(error){
        					// console.log(error);
    					}
			       	});    
			  	});

		  	});

		  	$('.deleteFaqButton').click(function(e){
		  		e.preventDefault();
	        	var faqId = $(this).attr('data-id');
	        	$('#deleteFAQModal').modal('show');

	        	$('button#confirm').click(function(){
	        		$.ajax({
	        			headers: {
		                  'X-CSRF-TOKEN': $('#deleteFAQModal').find('input[name$="_token"]').attr('value')
		                },

			            url: ' /admin/faqs/' +  faqId,
			            type: 'DELETE',
			             success: function(data)
			             {   
			             	$('#deleteFAQModal').find('div.modal-body').html('FAQ Deleted successfully');
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