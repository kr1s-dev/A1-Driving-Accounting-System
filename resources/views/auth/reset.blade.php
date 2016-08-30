@extends('master_layout.master_auth_layout')
@section('content')
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col l4 m6 s12 offset-l4 offset-m3">
                <div class="card-panel">
                    <h4 class="header2">RESET PASSWORD</h4>
                    <div class="divider"></div>
                    <div class="row">
                        {{Form::open(array('url' => 'password/reset', 'method' => 'POST'))}}
                            <input id="name3" type="hidden" name="token" value="{{$token}}">
                            <input id="name3" type="hidden" name="email" value="{{$email}}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input id="name3" type="password" name="password">
                                    <label for="email" class="">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input id="name3" type="email" name="password_confirmation">
                                    <label for="email" class="">Confirm Password</label>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="input-field col s12 right-align">
                                <button class="btn btn-large red darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-action-lock-open"></i> Submit</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection