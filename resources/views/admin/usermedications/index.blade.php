@extends('layouts.appsecond', ['menu' => 'residents'])

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
                <h1 class="title">Resident Medications ({{ $user->name }}) </h1>
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
                <h2 class="title pull-left">Medications</h2>
                <div class="actions panel_actions pull-right">
                	<a href="{{ route('usermedications.createusermedication', $user->id) }}" class="btn btn-success">Add</a>
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
                                        <th>Name</th>
                                        <th>Daily Count</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>comment</th>
                                        <th>Attached File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$usermedications) {
	                                		$i = 1;
		                                	foreach($usermedications as $usermedication) { ?>
		                                		<tr>
		                                			<?php 
	                                                	$usermedications = $usermedication->getMedications($usermedication->id);
	                                                ?>

		                                			<td>{{ $i }}</td>
		                                			<td>{{ $usermedication->sign_date }}</td>
		                                			<td>{{ $usermedications->name }}</td>
			                                        <td>
			                                            <div class="">
			                                                <h6>{{ $usermedication->daily_count }}</h6>
			                                            </div>
			                                        </td>
			                                        <td>
			                                        	<span class="badge round-primary">{{ $usermedication->duration }}</span>
			                                        </td>
			                                        <td>
			                                        	<?php 
			                                        		if ($usermedication->status == 1) {
			                                        			$css = "background-color: #de8383;";
			                                        		}else{
			                                        			$css = "background-color: #4d9cf8;";
			                                        		}
			                                        	?>
			                                        	<span class="badge round-primary" style="<?= $css; ?>">{{ App\Usermedications::getStatus($usermedication->status) }}</span>
			                                        </td>
			                                        <td>
			                                        	{{ $usermedication->comment }}
			                                        </td>
			                                        <td>
			                                        	<a href="{{ asset('uploads/').'/'.$usermedication->file }}">{{ $usermedication->file }}</a>
			                                        </td>
			                                        <td>
			                                        	@if(auth()->user()->hasRole('admin'))
					                                        <a href="{{ route('usermedications.assign', $usermedication->id) }}" class="btn btn-default">Assign</a>
					                                    @endif
			                                        	
			                                        	<a href="{{ route('usermedications.show', $usermedication->id) }}" class="btn btn-success">Edit</a>
			                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$usermedication->id}}').submit();">Delete</a>

			                                        	<form id="delete-form-{{$usermedication->id}}" action="{{ route('usermedications.destroy', $usermedication->id) }}" method="POST" style="display: none;">
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