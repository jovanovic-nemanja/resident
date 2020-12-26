@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	@endif

	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Activities</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-muted">Home &nbsp;</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-50 symbol-lg-120">
                                    <img src="{{ asset('uploads/').'/'.$user->profile_logo }}" alt="image" class="custom_img_tag">
                                </div>
                                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <a href="{{ route('resident.show', $user->id) }}" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $user->name }}</a>
                                        <a href="{{ route('resident.show', $user->id) }}">
                                            <i class="flaticon2-correct text-success font-size-h5"></i>
                                        </a>
                                    </div>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>

                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('useractivities.indexuseractivity', $user->id) }}">
			            		<h3 class="card-label" style="cursor: pointer; color: #4d9cf8; font-weight: bold;">Assigned Activities</h3>
			            	</a>
			                <a href="{{ route('useractivities.indexuseractivitygiven', $user->id) }}">
			                	<h3 class="card-label" style="cursor: pointer;" style="color: #000;">Given Activities</h3>
			                </a>
                        </div>
                        <div class="card-toolbar">
                            @if(auth()->user()->hasRole('admin'))
		                		<a href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $user->id]) }}" class="btn btn-success">Assign Primary ADL</a>
			                	<a href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $user->id]) }}" class="btn btn-primary">Assign Secondary ADL</a>
							@endif
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
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
		                                			<td>{{ $useractivity->start_day }} ~ {{ $useractivity->end_day }}</td>
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


												            <a href="" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('give-activity-form-{{$useractivity->id}}').submit();">Give Activity</a>

															<form id="give-activity-form-{{$useractivity->id}}" action="{{ route('useractivities.store') }}" method="POST" style="display: none;">
											                  	<input type="hidden" name="_method" value="POST">
											                  	@csrf

											                  	<input type="hidden" name="resident" value="{{ $user->id }}">
											                  	<input type="hidden" name="comment" class="comm_val" />
	                            								<input type="hidden" name="assign_id" value="{{ $useractivity->id }}">
												            </form>


												            <a href="" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('stop-activity-form-{{$useractivity->id}}').submit();">Stop</a>

															<form id="stop-activity-form-{{$useractivity->id}}" action="{{ route('useractivities.stop') }}" method="POST" style="display: none;">
											                  	<input type="hidden" name="_method" value="POST">
											                  	@csrf

											                  	<input type="hidden" name="resident" value="{{ $user->id }}">
	                            								<input type="hidden" name="activity_id" value="{{ $useractivity->id }}">
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
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
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