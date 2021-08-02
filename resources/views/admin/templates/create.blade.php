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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Create Template - {{ $template->id }}</h2>
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
                            <h3 class="card-label">Create Template - {{ $template->id }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="dropdown custom_drop_down">
                                <button class="btn btn-danger dropdown-toggle custom_div_tag" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('templates.createactivity', $template->id) }}">Activity</a>

                                    <a class="dropdown-item" href="{{ route('templates.createbodyharmcomment', $template->id) }}">Body Harm Comment</a>

                                    <a class="dropdown-item" href="{{ route('templates.createhealthcarecentertypes', $template->id) }}">Health Care Center Types</a>

                                    <a class="dropdown-item" href="{{ route('templates.createincidences', $template->id) }}">Incidences</a>

                                    <a class="dropdown-item" href="{{ route('templates.createmedications', $template->id) }}">Medications</a>

                                    <a class="dropdown-item" href="{{ route('templates.createmoods', $template->id) }}">Moods</a>

                                    <a class="dropdown-item" href="{{ route('templates.createrelations', $template->id) }}">Relations</a>

                                    <a class="dropdown-item" href="{{ route('templates.createreminderconfigs', $template->id) }}">Reminder Configs</a>

                                    <a class="dropdown-item" href="{{ route('templates.createrepresentativetypes', $template->id) }}">Representative Types</a>

                                    <a class="dropdown-item" href="{{ route('templates.createroutes', $template->id) }}">Routes</a>
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
                                                        <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$activity->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$activity->id}}" action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('bodyharmcomments.show', $comment->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$comment->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$comment->id}}" action="{{ route('bodyharmcomments.destroy', $comment->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('healthcarecentertypes.show', $healthcarecentertype->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$healthcarecentertype->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$healthcarecentertype->id}}" action="{{ route('healthcarecentertypes.destroy', $healthcarecentertype->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('incidences.show', $incidence->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$incidence->id}}').submit();" class="btn btn-warning">Delete</a>

                                                        <form id="delete-form-{{$incidence->id}}" action="{{ route('incidences.destroy', $incidence->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('medications.show', $medication->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$medication->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$medication->id}}" action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('moods.show', $mood->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$mood->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$mood->id}}" action="{{ route('moods.destroy', $mood->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('relations.show', $relation->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$relation->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$relation->id}}" action="{{ route('relations.destroy', $relation->id) }}" method="POST" style="display: none;">
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
                                                            <a disabled class="btn btn-custom">Actived</a>
                                                        @else
                                                            <a href="{{ route('reminderconfigs.active', $reminderconfig->id) }}" class="btn btn-danger">Active</a>
                                                        @endif

                                                        <a href="{{ route('reminderconfigs.show', $reminderconfig->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$reminderconfig->id}}').submit();" class="btn btn-warning">Delete</a>

                                                        <form id="delete-form-{{$reminderconfig->id}}" action="{{ route('reminderconfigs.destroy', $reminderconfig->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('representativetypes.show', $type->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$type->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$type->id}}" action="{{ route('representativetypes.destroy', $type->id) }}" method="POST" style="display: none;">
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
                                                        <a href="{{ route('routes.show', $route->id) }}" class="btn btn-success">Edit</a>
                                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$route->id}}').submit();" class="btn btn-primary">Delete</a>

                                                        <form id="delete-form-{{$route->id}}" action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display: none;">
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