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
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-50 symbol-lg-120">
                                    <img src="{{ asset('uploads/').'/'.$resident->profile_logo }}" alt="image" class="custom_img_tag">
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
                                        <a href="{{ route('resident.show', $resident->id) }}" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $resident->firstname }}</a>
                                        <a href="{{ route('resident.show', $resident->id) }}">
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
                    <div class="card-header p-10">
                        <div class="card-title">
                            <h3 class="card-label">Reports</h3>
                            <input type="hidden" id="env_domain_url" value="{{ env('APP_URL') }}" />
                            <input type="hidden" id="resident_id" value="{{ $resident_id }}" />
                        </div>
                        <div class="card-right d-flex">
                            <select class="form-control types_resident mr-2" id="types_resident">
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

                            <select class="form-control nurse_resident mr-2" id="nurse_resident">
                                @if($nurses)
                                    <option value="">Choose Nurse...</option>
                                    <option value="1">Admin</option>
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

                            <select class="form-control durations_resident mr-2" id="durations_resident">
                                @if($active)
                                    @if($active['durations'] == 1)
                                        <option value="">Choose Duration...</option>
                                        <option value="1" selected>Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3">Week</option>
                                        <option value="4">Month</option>
                                        <option value="5">Range</option>
                                    @elseif($active['durations'] == 2)
                                        <option value="">Choose Duration...</option>
                                        <option value="1">Today</option>
                                        <option value="2" selected>Yesterday</option>
                                        <option value="3">Week</option>
                                        <option value="4">Month</option>
                                        <option value="5">Range</option>
                                    @elseif($active['durations'] == 3)
                                        <option value="">Choose Duration...</option>
                                        <option value="1">Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3" selected>Week</option>
                                        <option value="4">Month</option>
                                        <option value="5">Range</option>
                                    @elseif($active['durations'] == 4)
                                        <option value="">Choose Duration...</option>
                                        <option value="1">Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3">Week</option>
                                        <option value="4" selected>Month</option>
                                        <option value="5">Range</option>
                                    @elseif($active['durations'] == 5)
                                        <option value="">Choose Duration...</option>
                                        <option value="1">Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3">Week</option>
                                        <option value="4">Month</option>
                                        <option value="5" selected>Range</option>
                                    @else
                                        <option value="">Choose Duration...</option>
                                        <option value="1">Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3">Week</option>
                                        <option value="4">Month</option>
                                        <option value="5">Range</option>
                                    @endif
                                @else
                                    <option value="">Choose Duration...</option>
                                    <option value="1">Today</option>
                                    <option value="2">Yesterday</option>
                                    <option value="3">Week</option>
                                    <option value="4">Month</option>
                                    <option value="5">Range</option>
                                @endif
                            </select>

                            <input type="date" name="start_time_resident" id="start_time_resident" class="start_time_resident form-control" />
                            <input type="date" name="end_time_resident" id="end_time_resident" class="end_time_resident form-control" />

                            <button name="search" id="search_resident" class="btn btn-success btn-sm form-control search_resident">Search</button>
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Nurse Name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="reports_resident_tbody">
                                <?php 
                                    if(@$reports) {
                                        $i = 1;
                                        foreach($reports as $rep) { ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ App\Reports::getTypeById($rep->type) }}</td>
                                                <td>{{ $rep->description }}</td>
                                                <td>{{ App\User::getUsernameById($rep->user_id) }}</td>
                                                <td>{{ $rep->created_at }}</td>
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