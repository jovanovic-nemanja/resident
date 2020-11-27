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
            	<a href="{{ route('usermedications.indexusermedication', $user->id) }}">
            		<h2 class="title pull-left assigned_adl" style="cursor: pointer;">Assigned Medications</h2>
            	</a>
                <a href="{{ route('usermedications.indexusermedicationgiven', $user->id) }}">
                	<h2 class="title pull-left given_adl" style="cursor: pointer; color: #4d9cf8; font-weight: bold;">Given Medications</h2>
                </a>
                
                <div class="actions panel_actions pull-right">
                	@if(auth()->user()->hasRole('admin'))
                		<a style="padding: 7px 18px; font-size: initial;" href="{{ route('usermedications.createassignmedication', $user->id) }}" class="btn btn-success">Assign</a>
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
                                        <th>Time</th>
                                        <th>Route</th>
                                        @if(auth()->user()->hasRole('care taker'))
											<th>Comment</th>
										@endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$arrs) {
	                                		$i = 1;
		                                	foreach($arrs as $assignmedication1) { 
		                                		$flag1 = App\Usermedications::getassignedMedication($assignmedication1['id']);
		                                		if($flag1 == 2) { ?>
			                                		<tr role='row' data-toggle="collapse" data-target="#demo<?= $assignmedication1['id'] ?>" class="odd accordion-toggle">
			                                			<?php 
		                                                	$medications1 = App\Assignmedications::getMedications($assignmedication1['id']);
		                                                ?>

			                                			<td>{{ $i }}</td>
			                                			<td><?= date_format(date_create($assignmedication1['sign_date']), 'Y-m-d'); ?></td>
			                                			<td>{{ $medications1->name }}</td>
				                                        <td>
				                                            <div class="">
				                                                <h6>{{ $assignmedication1['dose'] }}</h6>
				                                            </div>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary">{{ $assignmedication1['time'] }}</span>
				                                        </td>
				                                        <td>
															<span class="badge round-primary">
																<?php if($assignmedication1['route'] != NULL) { ?>
																	{{ App\Routes::getRoutename($assignmedication1['route']) }}
																<?php } ?>
															</span>
				                                        </td>
				                                        
			                                        	@if(auth()->user()->hasRole('care taker'))
				                                        	<td>
																<select class="form-control" id="comment" name="comment">
																	<option value="">Choose Comment</option>
				                                                    @foreach($comments as $comment)
				                                                        <option value="{{ $comment->id }}">{{ $comment->name }}</option>
				                                                    @endforeach
																</select>
															</td>
														@endif
														
				                                        <td>
					                                        @if(auth()->user()->hasRole('admin'))
					                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$assignmedication1['id']}}').submit();">Delete</a>

					                                        	<form id="delete-form-{{$assignmedication1['id']}}" action="{{ route('usermedications.destroyassign', $assignmedication1['id']) }}" method="POST" style="display: none;">
												                  	<input type="hidden" name="_method" value="delete">
												                  	@csrf
													            </form>
						                                    @endif
						                                    @if(auth()->user()->hasRole('care taker'))
																<a class="btn btn-primary" style="cursor: not-allowed;">Given Medication</a>
															@endif
														</td>
				                                    </tr>
                                    <?php $i++; } } }else{ ?>

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

@section('script')
<script>
    $(document).ready(function(){
        $('#comment').change(function() {
        	var com_val = $(this).val();
        	$('.comm_val').val(com_val);
        });
    });
</script>
@endsection