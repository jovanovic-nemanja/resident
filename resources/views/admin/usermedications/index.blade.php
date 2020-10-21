@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

	<div class="col-xs-12">
        <div class="page-title">

            <div class="pull-left">
                <!-- PAGE HEADING TAG - START -->
                <h1 class="title">Resident Medications ({{ $user->name }}) </h1>
                <div class="doctors-head relative text-center">
	                <div class="patient-img img-circle">
	                    <a href="{{ route('resident.show', $user->id) }}">
	                        <img src="{{ asset('uploads/').'/'.$user->profile_logo }}" class="rad-50 center-block">
	                    </a>
	                </div>
	            </div>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Assigned Medications</h2>
                <div class="actions panel_actions pull-right">
                	@if(auth()->user()->hasRole('admin'))
                		<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('usermedications.createassignmedication', $user->id) }}" class="btn btn-success">Assign</a>
					@endif
                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive" data-pattern="priority-columns">
                            <table id="example-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Dose</th>
                                        <th>Duration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                	<?php 
                                		if(@$assignmedications) {
	                                		$i = 1;
		                                	foreach($assignmedications as $assignmedication) { ?>
		                                		<tr role='row' data-toggle="collapse" data-target="#demo<?= $assignmedication->id ?>" class="odd accordion-toggle">
		                                			<?php 
	                                                	$medications = $assignmedication->getMedications($assignmedication->id);
	                                                ?>

		                                			<td>{{ $i }}</td>
		                                			<td><?= date_format(date_create($assignmedication->sign_date), 'Y-m-d'); ?></td>
		                                			<td>{{ $medications->name }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6>{{ $assignmedication->dose }}</h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary">{{ $assignmedication->duration }}</span>
			                                        </td>

			                                        <td>
				                                        @if(auth()->user()->hasRole('admin'))
				                                        	<a href="{{ route('usermedications.showassign', $assignmedication->id) }}" class="btn btn-success">Edit</a>
				                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$assignmedication->id}}').submit();">Delete</a>

				                                        	<form id="delete-form-{{$assignmedication->id}}" action="{{ route('usermedications.destroyassign', $assignmedication->id) }}" method="POST" style="display: none;">
												                  <input type="hidden" name="_method" value="delete">
												                  @csrf
												            </form>
					                                    @endif
					                                    @if(auth()->user()->hasRole('care taker'))
															<a href="{{ route('usermedications.createusermedication', ['resident' => $user->id, 'assign_id' => $assignmedication->id, 'medication_id' => $medications->id]) }}" class="btn btn-primary">Give Medication</a>
														@endif
													</td>
			                                    </tr>
			                                    <tbody>
				                                    <?php 
				                                    	foreach ($usermedications as $usermedication) { 
				                                    		if ($usermedication->assign_id == $assignmedication->id) { ?>
					                                    		<tr>
				                                    				<td colspan="4" class="hiddenRow" style="border-top: none; padding: 0!important;">
													                    <div class="accordian-body collapse" id="demo<?= $assignmedication->id ?>"> 
													                      	<table class="table table-striped">
														                        <thead>
														                          	<tr>
																						<th>Date</th>
																						<th>Name</th>
																						<th>Dose</th>
																						@if(auth()->user()->hasRole('care taker'))
																							<th>Actions</th>
																						@endif
																						@if(auth()->user()->hasRole('admin'))
																							<th></th>
																						@endif
														                          	</tr>
														                        </thead>
														                        <tbody>
														                          	<tr>
																						<td>{{ $usermedication->sign_date }}</td>
																						<td>{{ $medications->name }}</td>
																						<td>3</td>
																						@if(auth()->user()->hasRole('care taker'))
													                                        <td>
													                                        	<!-- <a href="{{ route('usermedications.show', $usermedication->id) }}" class="btn btn-success">Edit</a> -->
													                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$usermedication->id}}').submit();">Delete</a>

													                                        	<form id="delete-form-{{$usermedication->id}}" action="{{ route('usermedications.destroy', $usermedication->id) }}" method="POST" style="display: none;">
																					                  <input type="hidden" name="_method" value="delete">
																					                  @csrf
																					            </form>
													                                        </td>
													                                    @endif

													                                    @if(auth()->user()->hasRole('admin'))
																							<td></td>
																						@endif
														                          	</tr>
														                        </tbody>
													                      	</table>
													                    </div>
												                  	</td>
												                </tr>
				                                    <?php } } ?>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop