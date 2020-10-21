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
                <h1 class="title">Incidences </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Incidences</h2>
                <div class="actions panel_actions pull-right">
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('incidences.create') }}" class="btn btn-success">Add</a>
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
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($incidences) {
	                                		$i = 1;
		                                	foreach($incidences as $incidence) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
			                                        <td>
			                                            <div class="designer-info">
			                                                <h6>{{ $incidence->title }}</h6>
			                                            </div>
			                                        </td>
			                                        
			                                        <td>{{ $incidence->getTypeasstring($incidence->type) }}</td>
			                                        <td>
			                                        	<span class="badge round-primary">{{ $incidence->sign_date }}</span>
			                                        </td>
			                                        <td>
			                                        	<a href="{{ route('incidences.show', $incidence->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$incidence->id}}').submit();" class="btn btn-warning">Delete</a>

			                                        	<form id="delete-form-{{$incidence->id}}" action="{{ route('incidences.destroy', $incidence->id) }}" method="POST" style="display: none;">
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