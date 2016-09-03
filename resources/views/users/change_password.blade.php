@extends('master_layout.master_page_layout')
@section('content')
  
  <!--start container-->
  <div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <div class="row">
          <div class="col s12 m12 l12">   
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col l6 m6 s12 offset-l3 offset-m3">
                  <div class="card-panel">
                    <div class="row">
                    </div>
                    <div class="row">
                      {!! Form::open(['url'=>'user/changepassword','method'=>'POST','class'=>'col s12']) !!}
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="name" type="password" name="old_password">
                            <label for="first_name">Old Password</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="name" type="password" name="new_password" required>
                            <label for="first_name">New Password</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="name" type="password" name="new_password_confirmation" required>
                            <label for="first_name">Confirm Password</label>
                          </div>
                        </div>
                        <div class="input-field col s12 right-align">       
                          <button class="btn btn-large red darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-action-lock-open"></i> Submit</button>
                        </div>
                      {!! Form::close() !!}
                    </div>
                    <div class="divider"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
  <!--end container-->
@endsection