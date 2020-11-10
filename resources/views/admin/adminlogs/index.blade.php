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
                <h1 class="title">Admin Logs </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Admin Logs</h2>
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
                                        <th>Caretaker</th>
                                        <th>Contents</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($adminlogs) {
	                                		$i = 1;
		                                	foreach($adminlogs as $adminlog) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>
                                                        <a href="{{ route('caretaker.show', $adminlog->caretakerId) }}">{{ App\User::getUsernameById($adminlog->caretakerId) }}</a>
                                                    </td>
			                                        <td>
			                                            <div class="designer-info">
			                                                <h6>{{ $adminlog->content }}</h6>
			                                            </div>
			                                        </td>
                                                    <td>{{ $adminlog->sign_date }}</td>
			                                        <td>
			                                        	<a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$adminlog->id}}').submit();" class="btn btn-primary">Delete</a>

			                                        	<form id="delete-form-{{$adminlog->id}}" action="{{ route('adminlogs.destroy', $adminlog->id) }}" method="POST" style="display: none;">
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