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
                <h1 class="title">PRN ({{ $user->name }}) </h1>
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
                <h2 class="title pull-left">PRN</h2>
                <div class="actions panel_actions pull-right">
                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('tfgs.createtfg', $user->id) }}" class="btn btn-success">Give</a>
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
                                        <th>Medication</th>
                                        <th>Time</th>
                                        <th>comment</th>
                                        @if(auth()->user()->hasRole('admin'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$tfgs) {
	                                		$i = 1;
		                                	foreach($tfgs as $tfg) { ?>
		                                		<tr>
		                                			<?php 
	                                                	$medication = $tfg->getMedication($tfg->id);
	                                                ?>

		                                			<td>{{ $i }}</td>
		                                			<td>{{ $tfg->sign_date }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6><?= $medication->name; ?></h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary">{{ $tfg->time }}</span>
			                                        </td>
			                                        <td>
			                                        	{{ $tfg->comment }}
			                                        </td>

                                                    @if(auth()->user()->hasRole('admin'))
		                                                <td>	
                                                            <a href="{{ route('tfgs.show', $tfg->id) }}" class="btn btn-success">Edit</a>
                                                            <a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$tfg->id}}').submit();">Delete</a>

                                                            <form id="delete-form-{{$tfg->id}}" action="{{ route('tfgs.destroy', $tfg->id) }}" method="POST" style="display: none;">
                                                                  <input type="hidden" name="_method" value="delete">
                                                                  @csrf
                                                            </form>                                     
			                                            </td>
                                                    @endif      
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