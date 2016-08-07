@extends('master_layout.master_auth_layout')
@section('content')
<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
        <i class="mdi-action-search active"></i>
        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
        <div class="row">
          <div class="col s12 m12 l12 white-text">
            <h5>Register</h5>
          </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->
{!! Form::open(array('url' => 'register', 'method' => 'POST')) !!}
    <!--start container-->
    <div class="container">
        <div class="section">

            <p class="caption">Register an account to access the system.</p>
            <div class="divider"></div>
            
            <!--Basic Form-->
            <div id="basic-form" class="section">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <div class="card-panel">
                            <h4 class="header2">Personal Information</h4>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" type="text" name="first_name" value="{{ old('first_name') }}">
                                        <label for="first_name">First Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" type="text" name="last_name" value="{{ old('last_name') }}">
                                        <label for="first_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" type="text" name="address" value="{{ old('address') }}">
                                        <label for="first_name">Address</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="number" type="text" name="telephone_number" value="{{ old('telephone_number') }}">
                                        <label for="email">Tel No.</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="number" type="text" name="mobile_number" value="{{ old('mobile_number') }}">
                                        <label for="email">Mobile No.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m12 l6">
                        <div class="card-panel">
                            <h4 class="header2">Account Information</h4>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="password_confirmation">
                                        <label for="password">Repeat Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
{!! Form::close() !!}
@endsection
