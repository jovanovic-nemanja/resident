@extends('layouts.appsecond', ['menu' => 'activities'])

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
                <h1 class="title">Activities </h1>
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
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('activities.create') }}" class="btn btn-success">Add</a>
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
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($activities) {
	                                		$i = 1;
		                                	foreach($activities as $activity) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $activity->getTypeasstring($activity->type) }}</td>
			                                        <td>
			                                            <!-- <div class="round">{{ $activity->title }}</div> -->
			                                            <div class="designer-info">
			                                                <h6>{{ $activity->title }}</h6>
			                                                <!-- <small class="text-muted">Male, 34 Years</small> -->
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<a href="{{ route('activities.show', $activity->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$activity->id}}').submit();" class="btn btn-primary">Delete</a>

			                                        	<form id="delete-form-{{$activity->id}}" action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: none;">
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