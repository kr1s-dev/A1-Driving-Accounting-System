@extends('master_layout.master_auth_layout')
@section('content')
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col l4 m6 s12 offset-l4 offset-m3">
                <div class="card-panel">
                    <h4 class="header2">RESET PASSWORD</h4>
                    @include('flash::message') 
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif 
                    <div class="divider"></div>
                    <div class="row">
                        {{Form::open(array('url' => 'password/email', 'method' => 'POST'))}}
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input id="name3" type="email" name="email" name="email" value="{{old('email')}}">
                                    <label for="email" class="">Email</label>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="input-field col s12 right-align">
                                <button class="btn btn-large red darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-action-lock-open"></i> Reset</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection