@extends('layouts.appsecond', ['menu' => 'caretaker'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Care givers</h2>
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
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Looking for Job actived - Care givers
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('caretaker.getExternaldata') }}" class="btn btn-success mr-3 font-weight-bolder">Looking for Job</a>
                            <a href="{{ route('caretaker.create') }}" class="btn btn-primary font-weight-bolder">Add</a>
                            <!--end::Button-->
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Profile_photo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(@$caretakers) {
                                        $i = 1;
                                        foreach($caretakers as $caretaker) { ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $caretaker->firstname." ".$caretaker->lastname }}</td>
                                                <td>
                                                    <div class="">
                                                        <h6><?= $caretaker->email; ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge round-primary">{{ $caretaker->phone_number }}</span>
                                                </td>
                                                <td>
                                                    @if($caretaker->profile_logo)
                                                        <div class="symbol symbol-circle symbol-lg-75">
                                                            <img src="<?= "https://bluecarecoach.com/uploads/".$caretaker->profile_logo ?>" class="rad-50 center-block custom_img_tag" alt="">
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                <?php $i++; } }else{ ?>

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