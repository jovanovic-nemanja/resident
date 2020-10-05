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
									<th width="50px">ID</th>
									<th>Sender</th>
									<th>Date</th>
									<th>Product Name</th>
									<th>Volume</th>
									<th>Unit</th>
									<!-- <th>Destination</th> -->
									<!-- <th>Additional Information</th> -->
									<!-- <th width="20%">Attached file</th> -->
									<th>Status</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $request)
								<tr>
									<td><?= date('Y')."/".date('m')."/" ?>{{ $request->id }}</td>
									<td>{{ $request->getUsername($request->sender) }}</td>
									<td>{{ $request->sign_date }}</td>
									<td>{{ $request->product_name }}</td>
									<td>{{ $request->volume }}</td>
									<td>{{ $request->getunit($request->unit) }}</td>
									<!-- <td>{{ $request->port_of_destination }}</td>						 -->
									<!-- <td>{{ $request->additional_information }}</td> -->
									<!-- <td style="vertical-align: middle;">
				                      @if($request->getfiles($request->id))
				                        <a href="{{ $request->getfiles($request->id) }}" class="" target="_blank">view</a>
				                      @endif
				                    </td> -->
									<td>{{ $request->getstatuesname($request->status) }}</td>
									<td>
										@if($request->status == 1 || $request->status == NULL)
											<a href="{{ route('requests.show', $request->id) }}" class="btn btn-primary btn-sm btn-flat" title="Approve">
												<i class="fa fa-check"></i>
											</a>
											<a href="{{ route('requests.assign', $request->id) }}" class="btn btn-primary btn-sm btn-flat" title="Assigning">
												<i class="fa fa-tags"></i>
											</a>
										@endif
										@if($request->status == 2)
											<a href="{{ route('requests.show', $request->id) }}" class="btn btn-primary btn-sm btn-flat" title="Pending">
												<i class="fa fa-ban"></i>
											</a>
										@endif

										<a href="{{ route('requests.view', $request->id) }}" class="btn btn-success btn-sm btn-flat" title="Detail">
											<i class="fa fa-edit"></i>
										</a>
											
										<a href="{{ route('requests.edit', $request->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete">
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