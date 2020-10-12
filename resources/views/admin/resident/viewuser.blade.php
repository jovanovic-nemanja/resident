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
                            <!-- <p class="desc g-text relative">Lorem ipsum dolor sit amet, Earum nes ciunt fugiat enim. Sequi quos labore.</p> -->
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
                        
                        <div class="col-xs-12 mb-30">
                            <div class="reminder-wrapper has-shadow2">
                               <div class="reminder-icon">
                                   <img src="{{ asset('newdesign/data/hos-dash/clock.png') }}" width="60" alt="">
                               </div>
                               <div class="reminder-content">
                                   <h4 class="w-text bold">Reminder Alarm</h4>
                                   <h5 class="g-text">ask about medicine</h5>
                               </div>
                            </div>
                        </div>
                        

                    </div>
                   
                </div>
            </div>
        </section>
    </div>
@stop