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
                <h2 class="title pull-left">Activities</h2>
                <div class="actions panel_actions pull-right">
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $user->id]) }}" class="btn btn-success">Assign Primary ADL</a>
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $user->id]) }}" class="btn btn-primary">Assign Secondary ADL</a>
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
                                		if(@$useractivities) {
	                                		$i = 1;
		                                	foreach($useractivities as $useractivity) { ?>
		                                		<tr>
		                                			<?php 
	                                                	$useractivities = $useractivity->getActivities($useractivity->id);
	                                                ?>

		                                			<td>{{ $i }}</td>
		                                			<td>{{ $useractivity->sign_date }}</td>
		                                			<td>{{ $useractivity->getTypeasstring($useractivities->type) }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6><?= $useractivities->title; ?></h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary" style="background-color: #d86060;">{{ $useractivity->time }}</span>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary">{{ App\Useractivities::getTypename($useractivity->type) }}</span>
			                                        </td>
			                                        <td>
			                                        	{{ App\Useractivities::getCommentById($useractivity->id) }}
			                                        </td>
			                                        <td>
			                                        	<a href="{{ route('useractivities.show', $useractivity->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$useractivity->id}}').submit();">Delete</a>

			                                        	<form id="delete-form-{{$useractivity->id}}" action="{{ route('useractivities.destroy', $useractivity->id) }}" method="POST" style="display: none;">
											                  <input type="hidden" name="_method" value="delete">
											                  @csrf
											            </form>
			                                        </td>
			                                    </tr>
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