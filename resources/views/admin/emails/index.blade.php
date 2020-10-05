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
									<th>From</th>
									<th>To</th>
									<th>Summary</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach($emails as $email)
								<tr>
									<td>{{ $email->id }}</td>
									<td>{{ $email->sender_address }}</td>
									<td>{{ $email->receiver_address }}</td>
									<td>{{ $email->header }}</td>
									<td>{{ $email->title }}</td>
									<td>{{ $email->description }}</td>
									<td>{{ $email->sign_date }}</td>
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