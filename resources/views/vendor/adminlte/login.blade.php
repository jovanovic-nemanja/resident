@extends('layouts.app')

@section('content')

    <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">    
        <div class="login-form-header">
             <img src="{{ asset('newdesign/data/icons/padlock.png') }}" alt="login-icon" style="max-width:64px">
             <div class="login-header">
                 <h4 class="bold color-white">Login Now!</h4>
                 <h4><small>Please enter your credentials to login.</small></h4>
             </div>
        </div>
       
        <div class="box login">

            <div class="content-body" style="padding-top:30px">

                <form id="msg_validate" action="{{ url(config('adminlte.login_url', 'login')) }}" class="no-mb no-mt" method="post">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! csrf_field() !!}

                            <?php if(@$msg) { ?>
                                <div class="alert alert-danger">
                                    {{ $msg }}
                                </div>
                            <?php } ?>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="form-label">Email</label>
                                <div class="controls">
                                    <input required type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label class="form-label">Password</label>
                                <div class="controls">
                                    <input required type="password" class="form-control" id="password" name="password" placeholder="Password"> 
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="pull-left">
                                <button type="submit" class="btn btn-primary mt-10 btn-corner right-15">Submit</button>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a> -->
            </div>
        </div>

        <p id="nav">
            <!-- <a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a> -->
        </p>

    </div>
@stop
