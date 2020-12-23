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
                <h1 class="title">Edit Vital Sign </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class="add-header-wrapper gradient-blue curved-section text-center">
            <div class="doctors-head relative text-center">
                <div class="patient-img img-circle">
                    <a href="{{ route('resident.show', $result['data']->resident_id) }}">
                        <img src="{{ asset('uploads/').'/'.$result['user']->profile_logo }}" class="rad-50 center-block">

                        <h4 style="color: #fff;">{{ $result['user']->name }}</h4>
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
                                <form action="{{ route('vitalsign.update', $result['data']->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="put">
                                    @csrf

                                    <input type="hidden" name="resident_id" value="{{ $result['data']->resident_id }}">

                                    <div class="row" >
                                        <div class="col-lg-4">
                                            <div class="form-group {{ $errors->has('temperature') ? 'has-error' : '' }}">
                                                <label class="form-label">Temperature <span>(°F)</span></label>
                                                <i class='fas fa-thermometer' style='font-size: 70px; color: red;'></i>
                                                <input type="text" name="temperature" class="form-control temperature" id="temperature" required value="{{ $result['data']->temperature }}" />

                                                @if ($errors->has('temperature'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('temperature') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group {{ $errors->has('blood_pressure') ? 'has-error' : '' }}">
                                                <label class="form-label">Blood Pressure <span>(mmHG)</span></label>
                                                <i class="fa fa-signal" aria-hidden="true" style="font-size: 70px; color: red;"></i>
                                                <input type="text" name="blood_pressure" class="form-control blood_pressure" id="blood_pressure" required value="{{ $result['data']->blood_pressure }}" />

                                                @if ($errors->has('blood_pressure'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('blood_pressure') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group {{ $errors->has('heart_rate') ? 'has-error' : '' }}">
                                                <label class="form-label">Heart Rate <span>(Per min)</span></label>
                                                <i class="fa fa-heart" aria-hidden="true" style="font-size: 70px; color: red;"></i>
                                                <input type='text' required class='form-control heart_rate' name='heart_rate' id='heart_rate' value="{{ $result['data']->heart_rate }}" />
                                                
                                                @if ($errors->has('heart_rate'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('heart_rate') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="padding-bottom-30" style="text-align: center; padding-top: 5%;">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary gradient-blue submit_btn">Submit</button>
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