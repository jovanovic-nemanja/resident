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
              		<h4>ID: <?= date('Y')."/".date('m')."/" ?>{{ $records->id }}</h4><br>
					<form method="post" action="{{ route('requests.store') }}" enctype="multipart/form-data">
		                @csrf
		                <div class="form-group">
		                	<div class="row">
								<div class="col-md-2">
									<label>Send Date : </label>
									<input type="hidden" name="id" value="{{ $records->id }}">
									<input disabled class="form-control sign_date" value="{{ $records->sign_date }}" />
								</div>
								<div class="col-md-2">
									<label>Sender Name : </label>
									<input disabled class="form-control sender" value="{{ $records->getUsername($records->sender) }}" />
								</div>
								<div class="col-md-2">
									<label>Product Name : </label>
									<input disabled class="form-control product_name_title" value="{{ $records->product_name }}" />
								</div>
								<div class="col-md-2">
									<label>Volume : </label>
									<input disabled class="form-control volume" value="{{ $records->volume }}" />
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-2">
									<label>Unit : </label>
									<input disabled class="form-control unit" value="{{ $records->getunit($records->unit) }}" />
								</div>
								<div class="col-md-2">
									<label>Destination : </label>
									<input disabled class="form-control port_of_destination" value="{{ $records->port_of_destination }}" />
								</div>
								<div class="col-md-4">
									<label>Additional Information : </label>
									<textarea rows="4" disabled class="form-control additional_information">{{ $records->additional_information }}</textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<label>Attached file : </label>
									@if($records->getfiles($records->id))
			                        	<a href="{{ $records->getfiles($records->id) }}" class="btn btn-primary" target="_blank">view</a>
			                      	@endif
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4">
									<label>Choose Sellers</label>
									<select class="js-example-basic-multiple choose_sellers" name="sellers[]" multiple='multiple' size="3" id="choose_sellers" required style="width:100%">
										@foreach($sellers as $seller)
											<?php 
												$mains = str_replace("[", "", $records->receiver);
												$main = str_replace("]", "", $mains);
												$diff = explode(",", $main);
												if (@$diff) {
													$arr = [];
													for ($i=0; $i < count($diff); $i++) { 
														array_push($arr, $diff[$i]);
													}
												} ?>
													@if(in_array($seller->id, $arr))
														<option value="{{ $seller->id }}" selected>{{ $seller->name }}</option>
													@else
														<option value="{{ $seller->id }}">{{ $seller->name }}</option>
													@endif
											<?php  ?>
										@endforeach
									</select>
								</div>
							</div>

							<div class="text-center" style="margin-top: 10px;">
		                        <button type="submit" class="btn btn-success">Save</button>
		                    </div>
		                </div>
		            </form>
				</div>
			</div>
		</div>
	</section>
@stop