@extends('layouts.dashboards')

@section('content')
<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
				<form action="{{ route('unit.update', $unit->id) }}" method="POST">
					@csrf

					<input type="hidden" name="_method" value="put">

					<div class="box">
						<div class="box-body">
							<div class="form-group">
								<label>Name</label>
								<input required type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ $unit->name }}" />
							</div>
						</div>

						<div class="box-footer">
							<button class="ps-btn btn-flat pull-right">Update Unit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop