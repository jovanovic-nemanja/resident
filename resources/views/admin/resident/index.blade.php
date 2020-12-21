@extends('layouts.appsecond', ['menu' => 'manageresident'])

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
                <h1 class="title">Residents </h1>
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
                <h2 class="title pull-left">Residents</h2>
                <div class="actions panel_actions pull-right">
                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('resident.add') }}" class="btn btn-success">Add</a>
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
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$residents) {
	                                		$i = 1;
		                                	foreach($residents as $resident) { ?>
		                                		@if($resident->hasRole('resident'))
			                                		<tr>
			                                			<td>{{ $i }}</td>
			                                			<td>{{ $resident->name }}</td>
			                                			<td>{{ App\User::getGender($resident->gender) }}</td>
				                                        <td>
				                                            <div class="">
				                                                <h6><?= $resident->email; ?></h6>
				                                            </div>
				                                        </td>
                                                        <td>{{ $resident->birthday }}</td>
                                                        <td>{{ $resident->address }}</td>
				                                        <td>
				                                        	<span class="badge round-primary">{{ $resident->phone_number }}</span>
				                                        </td>
				                                        <td>
                                                            @if($resident->profile_logo)
                                                                <img src="{{ asset('uploads/').'/'.$resident->profile_logo }}" class="rad-50 center-block" alt="">
                                                            @endif
				                                        </td>
				                                        <td>
				                                        	<a href="{{ route('resident.edit', $resident->id) }}" class="btn btn-success">Edit</a>

				                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$resident->id}}').submit();">Delete</a>

				                                        	<form id="delete-form-{{$resident->id}}" action="{{ route('resident.destroy', $resident->id) }}" method="POST" style="display: none;">
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