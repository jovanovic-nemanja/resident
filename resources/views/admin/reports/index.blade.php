@extends('layouts.appsecond', ['menu' => 'reports'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Reports</h2>
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
                    <div class="card-header p-10">
                        <div class="card-title">
                            <h3 class="card-label">Reports</h3>
                            <input type="hidden" id="env_domain_url" value="{{ env('APP_URL') }}" />
                        </div>
                        <div class="card-right d-flex">
                            <select class="form-control types mr-2" id="types">
                                @if($active)
                                    @if($active['typeID'] == 1)
                                        <option value="">Choose Anything...</option>
                                        <option value="1" selected>Primary Activity</option>
                                        <option value="2">Secondary Activity</option>
                                        <option value="3">Medication Routine</option>
                                        <option value="4">Medication PRN</option>
                                    @elseif($active['typeID'] == 2)
                                        <option value="">Choose Anything...</option>
                                        <option value="1">Primary Activity</option>
                                        <option value="2" selected>Secondary Activity</option>
                                        <option value="3">Medication Routine</option>
                                        <option value="4">Medication PRN</option>
                                    @elseif($active['typeID'] == 3)
                                        <option value="">Choose Anything...</option>
                                        <option value="1">Primary Activity</option>
                                        <option value="2">Secondary Activity</option>
                                        <option value="3" selected>Medication Routine</option>
                                        <option value="4">Medication PRN</option>
                                    @elseif($active['typeID'] == 4)
                                        <option value="">Choose Anything...</option>
                                        <option value="1">Primary Activity</option>
                                        <option value="2">Secondary Activity</option>
                                        <option value="3">Medication Routine</option>
                                        <option value="4" selected>Medication PRN</option>
                                    @else
                                        <option value="">Choose Anything...</option>
                                        <option value="1">Primary Activity</option>
                                        <option value="2">Secondary Activity</option>
                                        <option value="3">Medication Routine</option>
                                        <option value="4">Medication PRN</option>
                                    @endif
                                @else
                                    <option value="">Choose Anything...</option>
                                    <option value="1">Primary Activity</option>
                                    <option value="2">Secondary Activity</option>
                                    <option value="3">Medication Routine</option>
                                    <option value="4">Medication PRN</option>
                                @endif
                            </select>

                            <select class="form-control nurse mr-2" id="nurse">
                                @if($nurses)
                                    <option value="">Choose Nurse...</option>
                                    @if($active)
                                        @foreach($nurses as $nurse)
                                            <option value="{{ $nurse->id }}" <?php if($active['user_id'] == $nurse->id){echo 'selected';} ?>>{{ $nurse->firstname }}</option>
                                        @endforeach
                                    @else
                                        @foreach($nurses as $nurse)
                                            <option value="{{ $nurse->id }}">{{ $nurse->firstname }}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Resident Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Nurse Name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="reports_tbody">
                                <?php 
                                    if(@$reports) {
                                        $i = 1;
                                        foreach($reports as $rep) { ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ App\User::getUsernameById($rep->resident_id) }}</td>
                                                <td>{{ App\Reports::getTypeById($rep->type) }}</td>
                                                <td>{{ $rep->description }}</td>
                                                <td>{{ App\User::getUsernameById($rep->user_id) }}</td>
                                                <td>{{ $rep->sign_date }}</td>
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