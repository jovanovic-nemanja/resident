@extends('layouts.appsecond', ['menu' => 'manageresident'])

@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Residents</h2>
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
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Manage Residents
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('resident.add') }}" class="btn btn-primary font-weight-bolder">Add User</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Search Form-->
                        
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

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