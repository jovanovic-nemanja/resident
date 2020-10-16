@extends('layouts.appsecond', ['menu' => 'activities'])

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
                <h1 class="title">Medications </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Medications</h2>
                <div class="actions panel_actions pull-right">
                	<a href="{{ route('medications.create') }}" class="btn btn-success">Add</a>
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
                                        <th>Name</th>
                                        <th>Dose</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if($medications) {
	                                		$i = 1;
		                                	foreach($medications as $medication) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $medication->name }}</td>
			                                        <td>
			                                            <div class="designer-info">
			                                                <h6>{{ $medication->dose }}</h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<img class="rad-50 center-block" src="{{ asset('uploads/').'/'.$medication->photo }}" />
			                                        </td>
			                                        <td>
			                                        	<a href="{{ route('medications.show', $medication->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$medication->id}}').submit();" class="btn btn-primary">Delete</a>

			                                        	<form id="delete-form-{{$medication->id}}" action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display: none;">
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