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
				<a href="{{ route('unit.create') }}" class="ps-btn btn-sm btn-flat">Create Unit</a>
			</div>
			<br>
            <div class="row">
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Name</th>
									<th>Date</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $unit)
								<tr>
									<td>{{ $unit->id }}</td>
									<td>{{ $unit->name }}</td>
									<td>{{ $unit->sign_date }}</td>
									<td>
										<a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-primary btn-sm btn-flat">
											<i class="fa fa-edit"></i>
										</a>
										<a href="" onclick="event.preventDefault();
			                                 document.getElementById('delete-form-{{$unit->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
											<i class="fa fa-trash"></i>
										</a>

										<form id="delete-form-{{$unit->id}}" action="{{ route('unit.destroy', $unit->id) }}" method="POST" style="display: none;">
							                  <input type="hidden" name="_method" value="delete">
							                  @csrf
							            </form>
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