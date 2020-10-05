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
									<th>Date</th>
									<th>Title</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>
								@foreach($logs as $log)
									<tr>
										<td>{{ $log->id }}</td>
										<td>{{ $log->getAdminname($log->admin_id) }}</td>
										<td>{{ $log->sign_date }}</td>
										<td>{{ $log->title }}</td>
										<td>{{ $log->description }}</td>
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