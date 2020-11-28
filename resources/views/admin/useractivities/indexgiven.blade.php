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
                <h1 class="title">Resident Activities ({{ $user->name }}) </h1>
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
            	<a href="{{ route('useractivities.indexuseractivity', $user->id) }}">
            		<h2 class="title pull-left assigned_adl" style="cursor: pointer;">Assigned Activities</h2>
            	</a>
                <a href="{{ route('useractivities.indexuseractivitygiven', $user->id) }}">
                	<h2 class="title pull-left given_adl" style="cursor: pointer; color: #4d9cf8; font-weight: bold;">Given Activities</h2>
                </a>

                <div class="actions panel_actions pull-right">
                	@if(auth()->user()->hasRole('admin'))
                		<a style="padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $user->id]) }}" class="btn btn-success">Assign Primary ADL</a>
	                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $user->id]) }}" class="btn btn-primary">Assign Secondary ADL</a>
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
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Comment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$arrs) {
	                                		$i = 1;
		                                	foreach($arrs as $useractivity1) { 
		                                		$boolean = App\Useractivities::getCalculateDaysById($useractivity1->id);
		                                		if($boolean == -1) { ?>
			                                		<tr>
			                                			<?php 
		                                                	$useractivities1 = $useractivity1->getActivities($useractivity1->id);
		                                                ?>

			                                			<td>{{ $i }}</td>
			                                			<td>{{ $useractivity1->sign_date }}</td>
			                                			<td>{{ $useractivity1->getTypeasstring($useractivities1->type) }}</td>
				                                        <td>
				                                            <div class="">
				                                                <h6><?= $useractivities1->title; ?></h6>
				                                            </div>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary" style="background-color: #d86060;">{{ $useractivity1->time }}</span>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary">{{ App\Useractivities::getTypename($useractivity1->type) }}</span>
				                                        </td>
					                                        
				                                        <td>
				                                        	{{ App\Comments::getCommentById($useractivity1->id) }}
				                                        </td>
				                                        <td>
				                                        	@if(auth()->user()->hasRole('admin'))
				                                        		<a href="{{ route('useractivities.show', $useractivity1->id) }}" class="btn btn-success">Edit</a>
					                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$useractivity1->id}}').submit();">Delete</a>

					                                        	<form id="delete-form-{{$useractivity1->id}}" action="{{ route('useractivities.destroy', $useractivity1->id) }}" method="POST" style="display: none;">
													                  <input type="hidden" name="_method" value="delete">
													                  @csrf
													            </form>
															@else
																<a id="{{ $useractivity1->id }}" class="btn btn-default" style="cursor: not-allowed;">Given Activity</a>
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