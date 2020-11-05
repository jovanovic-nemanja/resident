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
                <h1 class="title">Edit Resident Activity </h1>
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
                            @if($result['type'] == 1)
                                <h2 class="title">Primary ADL</h2>
                            @else
                                <h2 class="title">Secondary ADL</h2>
                            @endif
                        </div>
                        <div class="actions panel_actions pull-right">
                            <a class="box_toggle fa fa-chevron-down"></a>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('useractivities.update', $result['useractivities']->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">

                                    <div class="row">
                                        <input type="hidden" name="resident" value="{{ $result['user']->id }}">

                                        <div class="col-lg-3 circle first_circle">
                                            <div class="form-group {{ $errors->has('activities') ? 'has-error' : '' }} circle_form">
                                                <label class="form-label">Activity</label>
                                                <select class="form-control activities" name="activities" required>
                                                    <option value="">Choose Activity</option>
                                                    @foreach($result['activities'] as $ac)
                                                        <option <?php if($ac->id==$result["activity"]->id){echo 'selected';} ?> value="{{ $ac->id }}">{{ $ac->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            @if ($errors->has('activities'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('activities') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 circle">
                                            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }} circle_form">
                                                <label class="form-label">Time</label>
                                                <input type="time" class="form-control" name='time' placeholder="Time" value="{{ $result['useractivities']->time }}" required id="time">
                                                @if ($errors->has('time'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 circle">
                                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }} circle_form">
                                                <label class="form-label">Time</label>
                                                <select class="form-control" id="duration" name="type" required>
                                                    <option value="">Choose</option>
                                                    <option value="1" <?php if($result["useractivities"]->type == 1){echo 'selected';} ?>>Daily</option>
                                                    <option value="2" <?php if($result["useractivities"]->type == 2){echo 'selected';} ?>>Weekly</option>
                                                    <option value="3" <?php if($result["useractivities"]->type == 3){echo 'selected';} ?>>Monthly</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 circle">
                                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }} circle_form">
                                                <label class="form-label">Comment</label>
                                                <select class="form-control" id="comment" name="comment">
                                                    <?php 
                                                        foreach ($result['comments'] as $com) { ?>
                                                            <option <?php if($result['useractivities']->comment == $com['id']){echo 'selected';} ?> value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('comment'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('comment') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col-lg-3 circle">
                                            <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }} circle_form">
                                                <label class="form-label">Attached File</label>
                                                <input type="file" name="file" class="form-control" id="file" placeholder="Attached File" value="{{ asset('uploads/').'/'.$result['useractivities']->file }}">
                                                @if ($errors->has('file'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> -->
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

        $('.validate_btn').click(function() {
            var activity = $('.activities').val();
            if (activity == '') {
                $('.first_circle').css('background-color', '#ea6b6b');
            }

            $('.submit_btn').click();
        });

        $('.activities').change(function() {
            $('#comment').empty();
            var activity = $(this).val();
            if (activity != '') {
                var url = $('#url').val();
                $('.first_circle').css('background-color', '#1cc6d8');
                $.ajax({
                    url: '/getcommentsbyactivity',
                    type: 'GET',
                    data: { activity : activity },
                    success: function(result, status) {
                        if (status) {
                            $('#comment').empty();
                            var element = "";
                            for (var i = 0; i < result.length; i++) {
                                element += "<option value=" + result[i]['id'] + ">" + result[i]['name'] + "</option>";
                            }
                            $('#comment').append(element);
                        }
                    }
                })
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