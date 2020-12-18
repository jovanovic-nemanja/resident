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
                <h1 class="title">Edit Resident Medication </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class="add-header-wrapper gradient-blue curved-section text-center">
            <div class="doctors-head relative text-center">
                <div class="patient-img img-circle">
                    <a href="{{ route('resident.show', $result['user']->id) }}">
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
                            
                        </div>
                        <div class="actions panel_actions pull-right">
                            <a class="box_toggle fa fa-chevron-down"></a>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('usermedications.update', $result['usermedications']->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">

                                    <input type="hidden" name="assign" value="1">
                                    
                                    <div class="row">
                                        <input type="hidden" name="resident" value="{{ $result['user']->id }}">

                                        <div class="col-lg-3">
                                            <div class="form-group {{ $errors->has('medications') ? 'has-error' : '' }}">
                                                <label class="form-label">Medication</label>
                                                <select class="form-control medications" name="medications" required>
                                                    <option value="">Choose Medication</option>
                                                    @foreach($result['allmedications'] as $ac)
                                                        <option <?php if($ac->id==$result["medication"]->id){echo 'selected';} ?> value="{{ $ac->id }}">{{ $ac->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            @if ($errors->has('medications'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('medications') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group {{ $errors->has('dose') ? 'has-error' : '' }}">
                                                <label class="form-label">Dose</label>
                                                <input type="number" class="form-control" name='dose' placeholder="Dose" value="{{ $result['usermedications']->dose }}" required id="dose">
                                                
                                                @if ($errors->has('dose'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('dose') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group {{ $errors->has('route') ? 'has-error' : '' }}">
                                                <label class="form-label">Route</label>
                                                <select class="form-control" id="route" name="route">
                                                    <?php 
                                                        foreach ($result['routes'] as $com) { ?>
                                                            <option <?php if($result['usermedications']->route == $com['id']){echo 'selected';} ?> value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php } ?>
                                                </select>

                                                @if ($errors->has('route'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('route') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 time">
                                            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                                <label class="form-label">Time 1 </label>
                                                <input type="time" class="form-control" id="time" name="time" placeholder="Time" value="{{ $result['usermedications']->time }}">
                                                @if ($errors->has('time'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" >
                                        <div class="col-lg-3">
                                            <div class="form-group {{ $errors->has('start_day') ? 'has-error' : '' }}">
                                                <label class="form-label">Start day</label>
                                                <input type="date" name="start_day" id="start_day" class="form-control start_day" required value="{{ $result['usermedications']->start_day }}" />

                                                @if ($errors->has('start_day'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('start_day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group {{ $errors->has('end_day') ? 'has-error' : '' }}">
                                                <label class="form-label">End day</label>
                                                <input type="date" name="end_day" id="end_day" class="form-control end_day" required value="{{ $result['usermedications']->end_day }}" />
                                                
                                                @if ($errors->has('end_day'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('end_day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="padding-bottom-30" style="text-align: center; padding-top: 5%;">
                                        <div class="">
                                            <button style="display: none;" type="submit" class="btn btn-primary gradient-blue submit_btn">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="padding-bottom-30" style="text-align: center; padding-top: 5%;">
                                    <div class="">
                                        <button class="btn btn-primary gradient-blue validate_btn">Submit</button>
                                    </div>
                                </div>
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
    $(document).ready(function(){
        $('.validate_btn').click(function() {
            var activity = $('.medications').val();
            if (activity == '') {
                $('.first_circle').css('background-color', '#ea6b6b');
            }

            $('.submit_btn').click();
        });

        $('.medications').change(function() {
            var activity = $(this).val();
            if (activity != '') {
                $('.first_circle').css('background-color', '#1cc6d8');
            }
        });
    });

    $(document).ready(function(){
        var cw = $('.circle').width();
        $('.circle').css({'height':cw+parseInt(30)+'px'});
    });

    $(window).resize(function(){
        var cw = $('.circle').width();
        $('.circle').css({'height':cw+parseInt(30)+'px'});
    });
</script>
@endsection