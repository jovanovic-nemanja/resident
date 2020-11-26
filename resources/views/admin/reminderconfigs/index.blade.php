@extends('layouts.appsecond', ['menu' => 'reminderconfigs'])

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
                <h1 class="title">Reminder Configs </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Reminder Configs</h2>
                <div class="actions panel_actions pull-right">
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('reminderconfigs.create') }}" class="btn btn-success">Add</a>
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
                                        <th>Minutes</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($reminderconfigs) {
	                                		$i = 1;
		                                	foreach($reminderconfigs as $reminderconfig) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $reminderconfig->minutes }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6>{{ App\ReminderConfigs::getActiveasString($reminderconfig->active) }}</h6>
			                                            </div>
			                                        </td>
			                                        <td>
                                                        @if($reminderconfig->active == 1)
                                                            <a disabled class="btn btn-default">Actived</a>
                                                        @else
                                                            <a href="{{ route('reminderconfigs.active', $reminderconfig->id) }}" class="btn btn-default">Active</a>
                                                        @endif

			                                        	<a href="{{ route('reminderconfigs.show', $reminderconfig->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$reminderconfig->id}}').submit();" class="btn btn-primary">Delete</a>

			                                        	<form id="delete-form-{{$reminderconfig->id}}" action="{{ route('reminderconfigs.destroy', $reminderconfig->id) }}" method="POST" style="display: none;">
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