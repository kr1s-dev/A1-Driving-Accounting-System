@extends('master_layout.master_page_layout')
@section('content')
  
  <!--start container-->
  <div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <h4 class="header">{{sprintf("%'.07d\n", $user->id)}} | {{$user->first_name}}&nbsp;{{$user->last_name}}</h4>
        <div class="row">
          <div class="col s12 m12 l12">   
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col l6 m6 s12">
                        <h4 class="header2">User Information</h4>
                      </div>
                      <div class="col l6 m6 s12">

                        <a href="{{route('user.edit',$user->id)}}" class="btn waves-effect waves-light cyan right" type="submit" name="action" style="margin-left:10px;">Update User
                          <i class="mdi-action-receipt right"></i>
                        </a>
                        @if(Auth::user()->id == $user->id)
                          <a href="{{route('user.changepassword',$user->id)}}" class="btn waves-effect waves-light cyan right" type="submit" name="action" >Change Password
                            <i class="material-icons left">assignment_late</i>
                          </a>
                        @elseif(!($user->is_active))
                          <a href="{{route('user.resetpassword',$user->id)}}" class="btn waves-effect waves-light cyan right" type="submit" name="action" >Reset Password
                            <i class="material-icons left">lock_open</i>
                          </a>
                        @endif

                      </div>
                    </div>
                    <div class="row">
                      <div class="col l3 m3 s12 style="padding: 10px;"">
                        <h6><strong>User Branch</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>
                          @if($user->branch_id != NULL)
                            {{$user->branchInfo->branch_name}}
                          @else
                            - 
                          @endif
                        </h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6><strong>First Name</strong></h6>
                      </div>
                      <div class="col l3 m3 s12 style="padding: 10px;"">
                        <h6>{{$user->first_name}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6><strong>Last Name</strong></h6>
                      </div>
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6>{{$user->last_name}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6><strong>Email Address</strong></h6>
                      </div>
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6>{{$user->email}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6><strong>Mobile Number</strong></h6>
                      </div>
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6>{{$user->mobile_number}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6><strong>Telephone Number</strong></h6>
                      </div>
                      <div class="col l3 m3 s12" style="padding: 10px;">
                        <h6>{{$user->telephone_number}}</h6>
                        </div>
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