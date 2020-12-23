@extends('layouts.appsecond', ['menu' => 'residents'])

@section('content')

    <div class="col-xs-12">
        <div class="page-title">

            <div class="pull-left">
                <!-- PAGE HEADING TAG - START -->
                <h1 class="title">Residents </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>
    <!-- MAIN CONTENT AREA STARTS -->

    <?php if(count($residents) > 0) { ?>
        @foreach($residents as $resident)
            <div class="col-lg-4">
                <section class="box " style="overflow: initial!important;">
                    <div class="content-body p">
                        <div class="row">
                            <div class="doctors-list patient relative">
                                <div class="doctors-head relative text-center">
                                    <div class="patient-img img-circle">
                                        <a href="{{ route('resident.show', $resident->id) }}">
                                            <img src="{{ asset('uploads/').'/'.$resident->profile_logo }}" class="rad-50 center-block" alt="">
                                            {{ $resident->name }}
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                </div><!-- end row -->
                                <div class="col-xs-12 mb-30">
                                    <div class="form-group no-mb">
                                        <div class="ui-dropdowns" data-example-id="single-button-dropdown">
                                            <div class="btn-group" style="width: 100%;">
                                                <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  style="width: 100%;">
                                                    Medications <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ route('usermedications.indexusermedication', $resident->id) }}">Routine</a></li>
                                                    <li><a href="{{ route('tfgs.indextfg', $resident->id) }}">PRN</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="ui-dropdowns" data-example-id="single-button-dropdown">
                                            <div class="btn-group" style="width: 100%;">
                                                <button type="button" class="btn btn-success btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  style="width: 100%;">
                                                    Daily Activities <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if(auth()->user()->hasRole('admin'))
                                                        <li>
                                                            <a href="{{ route('useractivities.indexuseractivity', $resident->id) }}">View ADL</a>
                                                        </li>
                                                        <li><a href="{{ route('useractivities.createuseractivity', ['type' => 1, 'resident' => $resident->id]) }}">Primary ADL</a></li>
                                                        <li><a href="{{ route('useractivities.createuseractivity', ['type' => 2, 'resident' => $resident->id]) }}">Secondary ADL</a></li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('useractivities.indexuseractivity', $resident->id) }}">View ADL</a>
                                                        </li>
                                                        <li><a href="{{ route('useractivities.indexuseractivity', $resident->id) }}">Primary ADL</a></li>
                                                        <li><a href="{{ route('useractivities.indexuseractivity', $resident->id) }}">Secondary ADL</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="ui-dropdowns" data-example-id="single-button-dropdown">
                                            <div class="btn-group" style="width: 100%;">
                                                <button type="button" class="btn btn-warning btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  style="width: 100%;">
                                                    Incidence <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Family visit</a></li>
                                                    <li><a href="#">Mood Change</a></li>
                                                    <li><a href="{{ route('bodyharm.indexbodyharm', $resident->id) }}">Body harm</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="ui-dropdowns" data-example-id="single-button-dropdown">
                                            <div class="btn-group" style="width: 100%;">
                                                <a href="{{ route('vitalsign.indexresidentvitalsign', $resident->id) }}" class="btn btn-danger btn-lg dropdown-toggle" style="width: 100%;">Vital Sign</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>                               
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    <?php } else { ?>
        <div class="card">
            <h4><strong>There is no resident at this moment</strong></h4>
        </div>
    <?php } ?>
@stop
