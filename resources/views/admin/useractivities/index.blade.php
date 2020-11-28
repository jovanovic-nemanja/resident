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
                <h1 class="title">Resident Activities ({{ $user->name }}) </h1>
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
            	<a href="{{ route('useractivities.indexuseractivity', $user->id) }}">
            		<h2 class="title pull-left assigned_adl" style="cursor: pointer; color: #4d9cf8; font-weight: bold;">Assigned Activities</h2>
            	</a>
                <a href="{{ route('useractivities.indexuseractivitygiven', $user->id) }}">
                	<h2 class="title pull-left given_adl" style="cursor: pointer;" style="color: #000;">Given Activities</h2>
                </a>

                <div class="actions panel_actions pull-right">
                	@if(auth()->user()->hasRole('admin'))
                		<a style="padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $user->id]) }}" class="btn btn-success">Assign Primary ADL</a>
	                	<a style="padding: 7px 18px; font-size: initial;" href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $user->id]) }}" class="btn btn-primary">Assign Secondary ADL</a>
					@endif
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
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Comment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                		if(@$arrs) {
	                                		$i = 1;
		                                	foreach($arrs as $useractivity) {
		                                		$boolean = App\Useractivities::getCalculateDaysById($useractivity->id);
		                                		if($boolean == 1) { ?>
			                                		<tr>
			                                			<?php 
		                                                	$useractivities = $useractivity->getActivities($useractivity->id);
		                                                ?>

			                                			<td>{{ $i }}</td>
			                                			<td>{{ $useractivity->sign_date }}</td>
			                                			<td>{{ $useractivity->getTypeasstring($useractivities->type) }}</td>
				                                        <td>
				                                            <div class="">
				                                                <h6><?= $useractivities->title; ?></h6>
				                                            </div>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary" style="background-color: #d86060;">{{ $useractivity->time }}</span>
				                                        </td>
				                                        <td>
				                                        	<span class="badge round-primary">{{ App\Useractivities::getTypename($useractivity->type) }}</span>
				                                        </td>
					                                        
				                                        <td>
				                                        	@if(auth()->user()->hasRole('admin'))
				                                        		{{ App\Useractivities::getCommentById($useractivity->id) }}
				                                        	@else
																<select class="form-control" id="comment" name="comment">
																	<option value="">Choose Comment</option>
				                                                    @foreach($comments as $comment)
				                                                        <option value="{{ $comment->id }}">{{ $comment->name }}</option>
				                                                    @endforeach
																</select>
															@endif
				                                        </td>
				                                        <td>
				                                        	@if(auth()->user()->hasRole('admin'))
				                                        		<a href="{{ route('useractivities.show', $useractivity->id) }}" class="btn btn-success">Edit</a>
					                                        	<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-form-{{$useractivity->id}}').submit();">Delete</a>

					                                        	<form id="delete-form-{{$useractivity->id}}" action="{{ route('useractivities.destroy', $useractivity->id) }}" method="POST" style="display: none;">
													                  <input type="hidden" name="_method" value="delete">
													                  @csrf
													            </form>
															@else
																<a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('give-activity-form-{{$useractivity->id}}').submit();">Give Activity</a>

																<form id="give-activity-form-{{$useractivity->id}}" action="{{ route('useractivities.store') }}" method="POST" style="display: none;">
												                  	<input type="hidden" name="_method" value="POST">
												                  	@csrf

												                  	<input type="hidden" name="resident" value="{{ $user->id }}">
												                  	<input type="hidden" name="comment" class="comm_val" />
                                    								<input type="hidden" name="assign_id" value="{{ $useractivity->id }}">
													            </form>
															@endif
				                                        </td>
				                                    </tr>
                                    <?php $i++; } } } else{ ?>

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
    $(document).ready(function(){
        $('#comment').change(function() {
            var cur_val = $(this).val();
            $('.comm_val').val(cur_val);
        })
    });
</script>
@endsection