@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')
	<style type="text/css">
		.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
		    /*border-top: 0;*/
		    text-align: left;
		}	

		.table-bordered {
		    border: 1px solid #ddd;
		}

		section.box .actions a {
		    color: #fff; 
		    font-size: 13px; 
		    margin-left: 0px; 
		    padding: 12px; 
		    cursor: pointer; 
		    text-decoration: none; 
		}
	</style>

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
                	<a href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $user->id]) }}" class="btn btn-success">Add Primary ADL</a>
                	<a href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $user->id]) }}" class="btn btn-primary">Add Secondary ADL</a>
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
                                        <th>comment</th>
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
			                                        	<span class="badge round-primary">{{ $useractivity->time }}</span>
			                                        </td>
			                                        <td>
			                                        	{{ $useractivity->comment }}
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