@extends('layouts.dashboards')

@section('content')
<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
				<form action="{{ route('unit.store') }}" method="POST">
					@csrf

					<div class="box">
						<div class="box-body">
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" placeholder="Name" required />
							</div>
						</div>

						<div class="box-footer">
							<button class="ps-btn btn-flat pull-right">Save Unit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop