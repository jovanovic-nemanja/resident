@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

	<div class="col-lg-4">
        <section class="box ">
            <div class="content-body p">
                <div class="row">
                    <div class="doctors-list patient relative">
                        <div class="doctors-head relative text-center" style="background-color: #5da6f9;">
                            <div class="patient-img img-circle">
                                <img src="{{ asset('uploads/').'/'.$user->profile_logo }}" class="rad-50 center-block" alt="">
                            </div>
                            <h3 class="header w-text relative bold">{{ $user->name }}</h3>
                            <br>
                        </div>
                        <div class="row">
                            <div class="patients-info relative" >
                                <div class="col-sm-6 col-xs-12">
                                    <div class="patient-card has-shadow2">
                                        <div class="doc-info-wrap">
                                            <div class="patient-info">
                                                <?php ($user->gender == 1) ? $gender = "Female" : $gender = "Male"; ?>
                                                <h5 class="bold"><?= $gender; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="patient-card has-shadow2">
                                        <div class="doc-info-wrap">
                                            <div class="patient-info">
                                                <?php $years = date('Y') - date_format(date_create($user->birthday), 'Y'); ?>
                                                <h5 class="bold"><?= $years; ?> years </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="patient-card has-shadow2">
                                        <div class="doc-info-wrap">
                                            <div class="patient-info">
                                                <h5 class="bold">{{ $user->address }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="patient-card has-shadow2">
                                        <div class="doc-info-wrap">
                                            <div class="patient-info">
                                                <h5 class="bold">{{ $user->phone_number }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div>                   
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-8">
        <section class="box nohidden has-border-left-3">
            <header class="panel_header">
                <h2 class="title pull-left">Quick Links</h2>
            </header>
            <div class="content-body" style="padding-bottom:0 !important">    
                <div class="row">
                    <div class="col-lg-4 no-pl no-pr">
                        <div class="tile-progress" style="border: 2px solid #4d9cf8; margin-left:15px;margin-right:15px;cursor:pointer">
                            <div class="content">
                                <h4 style="color: #000;">Medication</h4>
                                <!-- <p class="mt-10 text-center no-mb g-text">There are some features for Routine and PRN in here.</p> -->
                                <br>
                                <div class="flex-column" style="text-align: center;">
                                    <a href="{{ route('usermedications.indexusermedication', $user->id) }}" class="btn btn-primary dashboard">Routine</a>
                                    <a href="{{ route('tfgs.indextfg', $user->id) }}" class="btn btn-primary dashboard">PRN</a>
                                    <a href="{{ route('notifications.index') }}" class="btn btn-primary dashboard">Reminders</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 no-pl no-pr">
                        <div class="tile-progress" style="border: 2px solid #4CAF50; margin-left:15px;margin-right:15px;cursor:pointer">
                            <div class="content">
                                <h4 style="color: #000;">Daily Activity</h4>
                                <!-- <p class="mt-10 text-center no-mb g-text">There are some features for primary ADL and Secondary ADL.</p> -->
                                <br>
                                <div style="text-align: center;">
                                    <a href="{{ route('useractivities.indexuseractivity', $user->id) }}" class="btn btn-success dashboard">Primary ADL</a>
                                    <a href="{{ route('useractivities.indexuseractivity', $user->id) }}" class="btn btn-success dashboard">Secondary ADL</a>
                                    <a href="{{ route('notifications.index') }}" class="btn btn-success dashboard">Reminders</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 no-pl no-pr">
                        <div class="tile-progress" style="border: 2px solid #FFC107; margin-left:15px;margin-right:15px;cursor:pointer">
                            <div class="content">
                                <h4 style="color: #000;">Incidence</h4>
                                <!-- <p class="mt-10 text-center no-mb g-text">There are some features for Family Visit and Mood Change and Body Harm.</p> -->
                                <br>
                                <div style="text-align: center;">
                                    <a href="#" class="btn btn-warning dashboard">Family Visit</a>
                                    <a href="#" class="btn btn-warning dashboard">Mood Change</a>
                                    <a href="{{ route('bodyharm.indexbodyharm', $user->id) }}" class="btn btn-warning dashboard">Body Harm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop