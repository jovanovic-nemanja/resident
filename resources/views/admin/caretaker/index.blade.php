@extends('layouts.appsecond', ['menu' => 'caretaker'])

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
                <h1 class="title">Care takers </h1>
                <div class="doctors-head relative text-center">
	            </div>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Care takers</h2>
                <div class="actions panel_actions pull-right">
                	<a href="{{ route('caretaker.create') }}" class="btn btn-success">Add</a>
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
                                        <th>Username</th>
                                        <th>Email Address</th>
                                        <th>Phone Number</th>
                                        <th>Profile_photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$caretakers) {
	                                		$i = 1;
		                                	foreach($caretakers as $caretaker) { ?>
		                                		@if($caretaker->hasRole('care taker'))
			                                		<tr>
			                                			<td>{{ $i }}</td>
			                                			<td>{{ $caretaker->name }}</td>
			                                			<td>{{ $caretaker->username }}</td>
				                                        <td>
				                                            <div class="">
				                                                <h6><?= $caretaker->email; ?></h6>
				                                            </div>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary">{{ $caretaker->phone_number }}</span>
				                                        </td>
				                                        <td>
				                                        	<img src="{{ asset('uploads/').'/'.$caretaker->profile_logo }}" class="rad-50 center-block" alt="">
				                                        </td>
				                                        <td>
				                                        	<a href="{{ route('caretaker.show', $caretaker->id) }}" class="btn btn-success">Edit</a>
				                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$caretaker->id}}').submit();">Delete</a>

				                                        	<form id="delete-form-{{$caretaker->id}}" action="{{ route('caretaker.destroy', $caretaker->id) }}" method="POST" style="display: none;">
												                  <input type="hidden" name="_method" value="delete">
												                  @csrf
												            </form>
				                                        </td>
				                                    </tr>
				                                @endif
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