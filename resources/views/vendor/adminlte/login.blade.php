@extends('layouts.appsecond')

@section('content')
<div class='col-lg-6'>
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Login</h2>
            <div class="actions panel_actions pull-right">
                <a class="box_toggle fa fa-chevron-down"></a>
            </div>
        </header>
        <div class="content-body">

            <form id="msg_validate" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
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

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </div>
            </form>

            <!-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a> -->
        </div>
    </section>
</div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
