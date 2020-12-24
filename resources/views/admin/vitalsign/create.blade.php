@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')

	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="col-xs-12">
        <div class="page-title">

            <div class="pull-left">
                <!-- PAGE HEADING TAG - START -->
                <h1 class="title">Add Vital Sign </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class="add-header-wrapper gradient-blue curved-section text-center">
            <div class="doctors-head relative text-center">
                <div class="patient-img img-circle">
                    <a href="{{ route('resident.show', $resident) }}">
                        <img src="{{ asset('uploads/').'/'.$user->profile_logo }}" class="rad-50 center-block">

                        <h4 style="color: #fff;">{{ $user->name }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class=" bg-w">
            <div class="col-lg-10 col-lg-offset-1 col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <div class="row" style="text-align: center;">
                            <h2 class="title">Vital Sign</h2>
                        </div>
                        <div class="actions panel_actions pull-right">
                            <a class="box_toggle fa fa-chevron-down"></a>
                        </div>
                    </header>

                    <div class="content-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="commentForm" action="{{ route('vitalsign.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="resident_id" value="{{ $resident }}">

                                    <div id="pills" class='wizardpills'>
                                        <ul class="form-wizard">
                                            <li><a href="#pills-tab1" data-toggle="tab"><span>Temperature</span></a></li>
                                            <li><a href="#pills-tab2" data-toggle="tab"><span>Blood Pressure</span></a></li>
                                            <li><a href="#pills-tab3" data-toggle="tab"><span>Heart Rate</span></a></li>
                                        </ul>
                                        <div id="bar" class="progress active">
                                            <div class="progress-bar progress-bar-primary " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="pills-tab1">

                                                <h4>Temperature</h4>
                                                <br>
                                                
                                                <div class="form-group">
                                                    <label class="form-label">Temperature <span>(°F)</span></label>
                                                    <i class='fas fa-thermometer' style='font-size: 70px; color: red;'></i>
                                                    <div class="controls">
                                                        <input type="text" name="temperature" class="form-control temperature" id="temperature" placeholder="Temperature" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="pills-tab2">
                                                <h4>Blood Pressure</h4>
                                                <br>
                                                
                                                <div class="form-group">

                                                    <label class="form-label">Blood Pressure <span>(mmHG)</span></label>
                                                    <i class="fa fa-signal" aria-hidden="true" style="font-size: 70px; color: red;"></i>
                                                    <div class="controls">
                                                        <input type="text" name="blood_pressure" class="form-control blood_pressure" id="blood_pressure" placeholder="Blood Pressure" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="pills-tab3">
                                                <h4>Heart Rate</h4>
                                                <br>
                                                
                                                <div class="form-group">
                                                    <label class="form-label">Heart Rate <span>(Per min)</span></label>
                                                    <i class="fa fa-heart" aria-hidden="true" style="font-size: 70px; color: red;"></i>
                                                    <div class="controls">
                                                        <input type='text' placeholder='Heart Rate' class='form-control heart_rate' name='heart_rate' id='heart_rate' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <ul class="pager wizard">
                                                <li class="previous"><a href="javascript:;">Previous</a></li>
                                                <li class="next"><a href="javascript:;">Next</a></li>
                                                <li class="skip"><a href="javascript:;">Skip</a></li>
                                                <li class="finish"><button type="submit" class="btn btn-primary btn-corner">Finish</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    
</script>
@endsection