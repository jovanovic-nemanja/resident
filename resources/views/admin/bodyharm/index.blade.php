@extends('layouts.appsecond', ['menu' => 'residents'])

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
                <h1 class="title">Body Harm ({{ $user->name }}) </h1>
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
                <h2 class="title pull-left">Body Harms</h2>
                <div class="actions panel_actions pull-right">
                	<a style="color: #fff; padding: 7px 18px; font-size: initial;" href="{{ route('bodyharm.createbodyharm', $user->id) }}" class="btn btn-success">Add</a>
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
                                        <th>Comment</th>
                                        <th>Screen Shot</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$bodyharms) {
	                                		$i = 1;
		                                	foreach($bodyharms as $bodyharm) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $bodyharm->sign_date }}</td>
		                                			<td>{{ App\Bodyharms::getCommentbystring($bodyharm->comment) }}</td>
			                                        <td>
			                                        	<a target="_blank" href="{{ asset('uploads/').'/'.$bodyharm->screenshot_3d }}">
                                                            <img class="rad-50 center-block" src="{{ asset('uploads/').'/'.$bodyharm->screenshot_3d }}" style="margin-left: inherit!important;" />
                                                        </a>
			                                        </td>
			                                        <td>
			                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$bodyharm->id}}').submit();">Delete</a>

			                                        	<form id="delete-form-{{$bodyharm->id}}" action="{{ route('bodyharm.destroy', $bodyharm->id) }}" method="POST" style="display: none;">
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