@extends('layouts.dashboards')

@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="card">
      	<div class="card-body" style="padding: 5%;">
            <div class="row">
				<input type="hidden" class="url" value="{{ Route('products.deleteproductsbychoosing') }}" />
				<input type="hidden" class="checkVals" />

              	<div class="col-12">
          			<div class="table-responsive">
						<table id="order-listing" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><input type='checkbox' id="selectAll" /></th>
									<th width="50px">No</th>
									<th>Name</th>
									<th>Category</th>
									<th>User</th>
									<th>Image</th>
									<th>Status</th>
									<th>Date</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $product)
								<tr>
									<td><input type='checkbox' class='checks' name='checks' value='{{ $product->id }}' /></td>
									<td>{{ $product->id }}</td>
									<td>{{ str_limit($product->name, 30, '...') }}</td>
									<td>{{ $product->getCategoryname($product->category_id) }}</td>
									<td>{{ $product->getUsername($product->user_id) }}</td>
									<td>
										<?php 
											if(@$product->images->first()->url) { ?>
												<img class="img-fluid" width="100" src="{{ asset('uploads/') }}/{{ $product->images->first()->url }}" alt="">
											<?php }else{

											}
										?>
									</td>

									@if($product->status == 1 || $product->status == NULL)
										<td>Pending</td>
									@endif
									@if($product->status == 2)
										<td>Approved</td>
									@endif
									@if($product->status == 3)
										<td>Deleted</td>
									@endif
									
									<td>{{ $product->sign_date }}</td>
									<td>
										@if($product->status == 1 || $product->status == NULL)
											<a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm btn-flat" title="Approve">
												<i class="fa fa-check"></i>
											</a>
										@endif
										@if($product->status == 2)
											<a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm btn-flat" title="Pending">
												<i class="fa fa-ban"></i>
											</a>
										@endif

										<a href="{{ route('product.show', $product->slug) }}" class="btn btn-success btn-sm btn-flat" title="Detail">
											<i class="fa fa-edit"></i>
										</a>
											
										<a href="{{ route('products.edit', $product->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
              	</div>
         	</div>
        </div>
    </div>
@stop

@section('script')
	<script>
		$(document).ready(function () {
			var alls = $('#order-listing tbody').children();

			$('body').on('click', '#selectAll', function () {
				if ($(this).hasClass('allChecked')) {
					$('input[type="checkbox"]', alls).prop('checked', false);
					
					$('.checkVals').val('');

					$('.submit_checkbox').remove();
				} else {
					$('input[type="checkbox"]', alls).prop('checked', true);
					var ids = [];

					$('#order-listing input:checked').each(function() {
						if($(this).attr('id') == 'selectAll'){

						}else 
							ids.push($(this).val());
					});

					$('.checkVals').val(ids);

					$('#order-listing_filter label').after('<button class="ps-btn submit_checkbox" style="padding: 15px 30px; margin-left: 2%;">Delete</button>');
				}
				$(this).toggleClass('allChecked');

				$('.submit_checkbox').click(function() {
					submitcheck();
				});
			})
		});

		function submitcheck() {
			var ids = $('.checkVals').val();
			if(!ids) {
				alert('There are not any chosen items now.');
				return;
			}

			var href = $('.url').val();
			
			$.ajax({
				url: href,
				type: 'GET',
				data: { ids: ids },
				success: function(result, status) {
					if(result.status == 200) {
						window.location.href = window.location.href;
					}else{
						alert(result.msg);
					}
				}
			})
		};
	</script>
@endsection