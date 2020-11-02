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
                <h1 class="title">Reminders </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Reminders</h2>
                <div class="actions panel_actions pull-right">
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
                                        <th>Resident Name</th>
                                        <th>Contents</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($notifications) {
	                                		$i = 1;
		                                	foreach($notifications as $notification) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $notification->resident_name }}</td>
			                                        <td>
			                                            <div>
			                                                <h6>{{ $notification->contents }}</h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<a href="{{ route('notifications.confirmIsread', $notification->id) }}" class="btn btn-success">Confirm</a>
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