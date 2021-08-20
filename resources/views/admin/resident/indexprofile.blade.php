@extends('layouts.appsecond', ['menu' => 'profile'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">{{$setting_tab->name}}</h2>
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
										<a href="{{ route('resident.show', $user->id) }}" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $user->firstname }}</a>
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
		                	<h3 class="card-label">{{$setting_tab->name}}</h3>
                        </div>
                        <div class="card-toolbar">
                        	@if(auth()->user()->hasRole('clinicowner'))
		                		<a href="{{ route('resident.createprofile', [$user->id, $setting_tab->id]) }}" class="btn btn-primary font-weight-bolder">Add</a>
							@endif
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Field Name</th>
                                    <th>Chosen Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
                            		if(@$resident_settings) {
                                		$i = 1;
	                                	foreach($resident_settings as $resident_setting) { 
                                            if(@$resident_setting->fieldName) {
                                            ?>
		                                	<tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $resident_setting->fieldName }}</td>
                                                <td>{{ $resident_setting->typeName }}</td>
                                                <td>
                                                    <a href="{{ route('resident.showprofile', $resident_setting->id) }}" class="btn btn-success">Edit</a>
                                                    <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$resident_setting->id}}').submit();" class="btn btn-primary">Delete</a>

                                                    <form id="delete-form-{{$resident_setting->id}}" action="{{ route('resident.destroyprofile', $resident_setting->id) }}" method="POST" style="display: none;">
                                                          <input type="hidden" name="_method" value="delete">
                                                          @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                <?php $i++; } } }else{ ?>

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