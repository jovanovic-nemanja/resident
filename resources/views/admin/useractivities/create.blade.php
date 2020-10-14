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
                <h1 class="title">Add Resident Activity </h1>
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

                    <div class="row">
                        @if($result['type'] == 1)
                            <h4 style="color: #fff;">Primary ADL</h4>
                        @else
                            <h4 style="color: #fff;">Secondary ADL</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class=" bg-w">
            <div class="col-lg-10 col-lg-offset-1 col-xs-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Basic Info</h2>
                        <div class="actions panel_actions pull-right">
                            <a class="box_toggle fa fa-chevron-down"></a>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="{{ route('useractivities.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="resident" value="{{ $result['user']->id }}">
                                    <div class="row">
                                        <div class="col-md-3 form-group {{ $errors->has('activities') ? 'has-error' : '' }}">
                                            <label class="form-label">Activity</label>
                                            <div class="controls">
                                                <select class="form-control" name="activities" required>
                                                    <option value="">Choose Activity</option>
                                                    @foreach($result['activities'] as $ac)
                                                        <option value="{{ $ac->id }}">{{ $ac->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('activities'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('activities') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                            <label class="form-label">Time</label>
                                            <div class="controls">
                                                <input type="time" class="form-control" name='time' placeholder="Time" value="<?= date('H:i'); ?>" required id="time">
                                            </div>
                                            @if ($errors->has('time'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('time') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                                            <label class="form-label">Comment</label>
                                            <div class="controls">
                                                <textarea rows="7" class="form-control" id="comment" name="comment" placeholder="Comment" value="{{ old('comment') }}"></textarea>
                                            </div>
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                            <label class="form-label">Attached File</label>
                                            <div class="controls">
                                                <input type="file" name="file" class="form-control" id="file" placeholder="Attached File">
                                            </div>
                                            @if ($errors->has('file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="padding-bottom-30">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary gradient-blue">Save</button>
                                            <button type="button" class="btn">Cancel</button>
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
    $(document).ready(function(){
        // $("#time").on("focusout",function(e){
        //     var currentTime = new Date();
        //     var userTime = $("#time").val().split(":"); 
        //     if(currentTime.getHours() < parseInt(userTime[0])){
        //         alert("You can choose a time before current time.");
        //         $(this).focus();                
        //     }
        //     if(currentTime.getHours() >= parseInt(userTime[0])){
        //         if(currentTime.getMinutes() < parseInt(userTime[1])){
        //             alert("You can choose a time before current time.");
        //             $(this).focus();
        //         }
        //     }
        // });
    });
</script>
@endsection