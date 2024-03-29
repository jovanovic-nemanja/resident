@extends('layouts.appsecond', ['menu' => 'efax'])

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
                        <h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Efax List</h2>
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
                            <h3 class="card-label">Received Efax List
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <!-- <a href="{{ route('caretaker.create') }}" class="btn btn-primary font-weight-bolder">Add</a> -->
                            <!--end::Button-->
                        </div>
                    </div>
                        
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Fax ID</th>
                                    <th>Originating Fax Number</th>
                                    <th>Origination Fax TSID</th>
                                    <th>Completed Time</th>
                                    <th>Fax Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(@$lists) {
                                        $i = 1;
                                        foreach($lists['faxes'] as $list) {
                                            $image = App\User::getImageEfax($list['fax_id']);
                                            if(@$image['pages'][0]['image']) {
                                                $data = $image['pages'][0]['image'];
                                            }else{
                                                $data = '';
                                            }
                                         ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $list['fax_id'] }}</td>
                                                <td>{{ $list['originating_fax_number'] }}</td>
                                                <td>{{ $list['originating_fax_tsid'] }}</td>
                                                <td>{{ date('Y-m-d H:i:s', strtotime($list['completed_timestamp'])) }}</td>
                                                <td><a href="data:image/png;base64, <?= $data; ?>" download="<?= $list['fax_id'] ?>.png"><img src="data:image/png;base64, <?= $data; ?>" class="max-h-75px rad-50 center-block custom_img_tag" /></a></td>
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