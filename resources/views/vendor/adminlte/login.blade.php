@extends('layouts.applogin')

@section('content')

    <div class="u-container-layout u-container-layout-1">
        <h1 class="u-custom-font u-font-oswald u-text u-title u-text-1">BLUECARE HUB</h1>
        <div class="u-form u-form-1">
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="POST" class="u-clearfix u-form-spacing-15 u-form-vertical u-inner-form" style="padding: 15px;" source="custom" name="form">
                
                {!! csrf_field() !!}

                <?php if(@$msg) { ?>
                    <div class="alert alert-danger">
                        {{ $msg }}
                    </div>
                <?php } ?>

                <div class="u-form-group u-form-name u-form-group-1 {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="name-6797" class="u-form-control-hidden u-label">Name</label>
                    <input type="text" placeholder="Username" id="name-6797" name="username" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="u-form-group u-form-group-2 {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="email-6797" class="u-form-control-hidden u-label">Password</label>
                    <input type="password" placeholder="Password" id="email-6797" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-2" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="u-align-center u-form-group u-form-submit u-form-group-3">
                    <button type="submit" class="u-btn u-btn-submit u-button-style u-hover-palette-1-dark-3 u-palette-1-dark-2 u-btn-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop
