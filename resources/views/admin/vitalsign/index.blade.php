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
                <h1 class="title">Vital Sign ({{ $user->name }}) </h1>
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
                <div class="actions panel_actions pull-right">
                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('vitalsign.createvitalsign', $user->id) }}" class="btn btn-primary">Add</a>
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
                                        <th>Temperature</th>
                                        <th>Heart Rate</th>
                                        <th>Blood Pressure</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$vitalsigns) {
	                                		$i = 1;
		                                	foreach($vitalsigns as $vitalsign) { ?>
		                                		<tr>
		                                			<td>{{ $i }}</td>
		                                			<td>{{ $vitalsign->sign_date }}</td>
		                                			<td>{{ $vitalsign->temperature }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6><?= $vitalsign->heart_rate; ?></h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary" style="background-color: #d86060;">{{ $vitalsign->blood_pressure }}</span>
			                                        </td>
			                                        <td>
		                                        		<a href="{{ route('vitalsign.show', $vitalsign->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$vitalsign->id}}').submit();">Delete</a>

			                                        	<form id="delete-form-{{$vitalsign->id}}" action="{{ route('vitalsign.destroy', $vitalsign->id) }}" method="POST" style="display: none;">
									                  		<input type="hidden" name="_method" value="delete">
									                  		@csrf
											            </form>
			                                        </td>
			                                    </tr>
                                    <?php $i++; } } else{ ?>

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

@section('script')
<script>
    
</script>
@endsection