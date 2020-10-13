@extends('layouts.appsecond', ['menu' => 'activities'])

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
                <h1 class="title">Edit Activity </h1>
                <!-- PAGE HEADING TAG - END -->
            </div>

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12">
        <div class=" bg-w" style="padding-top: 1%;">
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
                                <form action="{{ route('activities.update', $result->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="put">

                                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <label class="form-label">Type</label>
                                        <div class="controls">
                                            <?php if($result->type == 1) {
                                                $selected1 = "selected"; 
                                                $selected2 = "";
                                            }else{
                                                $selected2 = "selected"; 
                                                $selected1 = "";
                                            } ?>
                                            <select class="form-control" name="type" required>
                                                <option value="">Choose Type</option>
                                                <option value="1" <?= $selected1; ?>>Primary ADL</option>
                                                <option value="2" <?= $selected2; ?>>Secondary ADL</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label class="form-label">Title</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name='title' placeholder="Title" required value="{{ $result->title }}">
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
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