@extends('layouts.appsecond', ['menu' => 'caretaker'])

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
                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('caretaker.create') }}" class="btn btn-success">Add</a>
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