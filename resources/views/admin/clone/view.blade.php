@extends('layouts.appsecond', ['menu' => 'clone'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">View Template - ({{ $template->name }})</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('clone.index') }}" class="text-muted">Templates &nbsp;</a>
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
                            <h3 class="card-label">View Template - ({{ $template->name }})</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="dropdown custom_drop_down">
                                
                            </div>
                        </div>
                    </div>
                        
                    <div class="card-body row">
                        <div class="col-lg-6" id="activities">
                            <h4>Activities</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($activities) {
                                            $i = 1;
                                            foreach($activities as $activity) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ App\Activities::getTypeasstring($activity->type) }}</td>
                                                    <td>
                                                        {{ $activity->title }}
                                                    </td>
                                                    <td>{{ $activity->comments }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6" id="bodyharm_comments">
                            <h4>Body Harm Comments</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_1" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($comments) {
                                            $i = 1;
                                            foreach($comments as $comment) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $comment->name }}</td>
                                                    <td>
                                                        <div class="designer-info">
                                                            <h6>{{ $comment->sign_date }}</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="healthcare_types">
                            <hr>
                            <hr>
                            <h4>Health Care Center Types</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_2" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($healthcarecentertypes) {
                                            $i = 1;
                                            foreach($healthcarecentertypes as $healthcarecentertype) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        {{ $healthcarecentertype->title }}
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="incidences">
                            <hr>
                            <hr>
                            <h4>Incidences</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_3" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($incidences) {
                                            $i = 1;
                                            foreach($incidences as $incidence) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        {{ $incidence->title }}
                                                    </td>
                                                    
                                                    <td>{{ $incidence->getTypeasstring($incidence->type) }}</td>
                                                    <td>
                                                        <span class="badge round-primary">{{ $incidence->sign_date }}</span>
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="medications">
                            <hr>
                            <hr>
                            <h4>Medications</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_4" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Dose</th>
                                        <th>Photo</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($medications) {
                                            $i = 1;
                                            foreach($medications as $medication) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $medication->name }}</td>
                                                    <td>
                                                        {{ $medication->dose }}
                                                    </td>
                                                    <td>
                                                        <?php if($medication->photo) { ?>
                                                            <div class="symbol symbol-circle symbol-lg-75">
                                                                <img class="rad-50 center-block custom_img_tag" src="{{asset('uploads/').'/'.$medication->photo }}" />
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>{{ $medication->comments }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="moods">
                            <hr>
                            <hr>
                            <h4>Moods</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_5" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($moods) {
                                            $i = 1;
                                            foreach($moods as $mood) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $mood->title }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="relations">
                            <hr>
                            <hr>
                            <h4>Relations</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_6" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($relations) {
                                            $i = 1;
                                            foreach($relations as $relation) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $relation->title }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="reminder_configs">
                            <hr>
                            <hr>
                            <h4>Reminder Configs</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_7" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Minutes</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($reminderconfigs) {
                                            $i = 1;
                                            foreach($reminderconfigs as $reminderconfig) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $reminderconfig->minutes }}</td>
                                                    <td>
                                                        <div class="">
                                                            <h6>{{ App\ReminderConfigs::getActiveasString($reminderconfig->active) }}</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="representative_types">
                            <hr>
                            <hr>
                            <h4>Representative Types</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_8" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($types) {
                                            $i = 1;
                                            foreach($types as $type) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        {{ $type->title }}
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-6 pt-5 mt-5" id="routes">
                            <hr>
                            <hr>
                            <h4>Routes</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_9" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($routes) {
                                            $i = 1;
                                            foreach($routes as $route) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $route->name }}</td>
                                                    <td>{{ $route->sign_date }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-12 pt-5 mt-5" id="units">
                            <hr>
                            <hr>
                            <h4>Units</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_11" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($units) {
                                            $i = 1;
                                            foreach($units as $unit) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $unit->title }}</td>
                                                    <td>{{ $unit->sign_date }}</td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>

                        <div class="col-lg-12 pt-5 mt-5" id="settings">
                            <hr>
                            <hr>
                            <h4>Settings</h4>
                            <br>
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_10" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tab Name</th>
                                        <th>Field Name</th>
                                        <th>Field Created Date</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(@$settings) {
                                            $i = 1;
                                            foreach($settings as $setting) { ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $setting->name }}</td>
                                                    <td>{{ $setting->fieldName }}</td>
                                                    <td>{{ $setting->sign_date_field }}</td>
                                                    <td>
                                                        <a href="{{ route('clone.showsetting', [$template->id, $setting->id]) }}" class="btn btn-success">View</a>
                                                    </td>
                                                </tr>
                                    <?php $i++; } }else{ ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@stop