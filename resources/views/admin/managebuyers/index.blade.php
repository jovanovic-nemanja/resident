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
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Block Status</th>
									<th>Sign Date</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $buyer)
									@if($buyer->hasRole('buyer'))
										<tr>
											<td>{{ $buyer->id }}</td>
											<td>{{ $buyer->name }}</td>
											<td>{{ $buyer->email }}</td>
											<td>{{ $buyer->getBlockstatus($buyer->block) }}</td>
											<td>{{ $buyer->sign_date }}</td>
											<td>
												@if($buyer->block == 0)
													<a title="Block" href="{{ route('managebuyers.edit', $buyer->id) }}" class="btn btn-danger btn-sm btn-flat">
														<i class="fa fa-warning"></i>
													</a>
												@endif
												@if($buyer->block == 1)
													<a title="Approve" href="{{ route('managebuyers.show', $buyer->id) }}" class="btn btn-success btn-sm btn-flat">
														<i class="fa fa-check"></i>
													</a>
												@endif
												
												<a title="Detail" href="{{ url('/userprofile/view', $buyer->id) }}" class="btn btn-success btn-sm btn-flat">
													<i class="fa fa-edit"></i>
												</a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop