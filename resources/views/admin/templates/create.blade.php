@extends('layouts.appsecond', ['menu' => 'templates'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Create Template - {{ $template->name }}</h2>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('templates.index') }}" class="text-muted">Templates &nbsp;</a>
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
                            <h3 class="card-label">Create Template - {{ $template->name }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="dropdown custom_drop_down">
                                <button class="btn btn-danger dropdown-toggle custom_div_tag" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 1]) }}">Activity</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 2]) }}">Body Harm Comment</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 3]) }}">Health Care Center Types</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 4]) }}">Incidences</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 5]) }}">Medications</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 6]) }}">Moods</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 7]) }}">Relations</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 8]) }}">Reminder Configs</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 9]) }}">Representative Types</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 10]) }}">Routes</a>

                                    <a class="dropdown-item" href="{{ route('templates.createsetting', [$template->id, 11]) }}">Settings</a>
                                </div>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $activity->id, 1]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$activity->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$activity->id}}" action="{{ route('templates.destroysetting', [$activity->id, 1]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
                                                    </td>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $comment->id, 2]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-comment-form-{{$comment->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-comment-form-{{$comment->id}}" action="{{ route('templates.destroysetting', [$comment->id, 2]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $healthcarecentertype->id, 3]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-health-type-form-{{$healthcarecentertype->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-health-type-form-{{$healthcarecentertype->id}}" action="{{ route('templates.destroysetting', [$healthcarecentertype->id, 3]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $incidence->id, 4]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-incidence-form-{{$incidence->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-incidence-form-{{$incidence->id}}" action="{{ route('templates.destroysetting', [$incidence->id, 4]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $medication->id, 5]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-medication-form-{{$medication->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-medication-form-{{$medication->id}}" action="{{ route('templates.destroysetting', [$medication->id, 5]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
                                                    </td>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $mood->id, 6]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-mood-form-{{$mood->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-mood-form-{{$mood->id}}" action="{{ route('templates.destroysetting', [$mood->id, 6]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
                                                    </td>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $relation->id, 7]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-relation-form-{{$relation->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-relation-form-{{$relation->id}}" action="{{ route('templates.destroysetting', [$relation->id, 7]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
                                                    </td>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        @if($reminderconfig->active == 1)
                                                            <a disabled class="btn btn-custom" style="cursor: not-allowed;">Actived</a>
                                                        @else
                                                            <a href="{{ route('templates.activeReminderconfig', $reminderconfig->id) }}" class="btn btn-danger">Active</a>
                                                        @endif

                                                        <a href="{{ route('templates.showsetting', [$template->id, $reminderconfig->id, 8]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-reminderconfig-form-{{$reminderconfig->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-reminderconfig-form-{{$reminderconfig->id}}" action="{{ route('templates.destroysetting', [$reminderconfig->id, 8]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $type->id, 9]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-type-form-{{$type->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-type-form-{{$type->id}}" action="{{ route('templates.destroysetting', [$type->id, 9]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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
                                        <th>Actions</th>
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
                                                    <td>
                                                        <a href="{{ route('templates.showsetting', [$template->id, $route->id, 10]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-route-form-{{$route->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-route-form-{{$route->id}}" action="{{ route('templates.destroysetting', [$route->id, 10]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
                                                    </td>
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
                                        <th>Actions</th>
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
                                                        <a href="{{ route('templates.showsetting', [$template->id, $setting->id, 11]) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-settings-form-{{$setting->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-settings-form-{{$setting->id}}" action="{{ route('templates.destroysetting', [$setting->id, 11]) }}" method="POST" style="display: none;">
                                                            <input type="hidden" name="_method" value="delete">
                                                            @csrf
                                                        </form>
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