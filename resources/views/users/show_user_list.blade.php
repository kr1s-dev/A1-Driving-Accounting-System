@extends('master_layout.master_page_layout')
@section('content')
 
        

  <!--start container-->
  <div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <h4 class="header">View All Users</h4>
        <div class="row">
          <div class="col s12 m12 l12">
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile No.</th>
                  <th>User Type</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile No.</th>
                  <th>User Type</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
                 
              <tbody>
                  @if($userList != NULL)
                    @foreach($userList as $user)
                      <tr>
                          <td>{{$user->first_name}}</td>
                          <td>{{$user->last_name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->mobile_number}}</td>
                          <td>{{$user->userType->type}}</td>
                          <td class="center-align">
                            <a href="{{route('user.edit',$user->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                              <i class="mdi-content-create"></i>
                            </a>

                            <a href="{{route('user.resetpassword',$user->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                              <i class="mdi-content-create"></i>
                            </a>
                            @if(Auth::user()->id != $user->id)
                              @if($user->is_active)
                                {!! Form::model($user, ['method'=>'DELETE','action' => ['Users\UserController@destroy',$user->id] , 'class' => 'form-horizontal form-label-left form-wrapper']) !!}
                                    <button type="submit" class="btn-floating waves-effect waves-light grey darken-4" onclick="return confirm('Are you sure you want to lock this user?');"><i class="mdi-action-lock"></i> </button>
                                {!! Form::close() !!}
                              @else 
                              @endif
                            @endif
                          </td>
                      </tr>
                    @endforeach
                  @endif
              </tbody>
            </table>
          </div>
        </div>
      </div> 
      <br>
    </div>
  </div>
  <!-- Floating Action Button -->
  <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
    <a href="{{route('user.create')}}" class="btn-floating btn-large red darken-2">
      <i class="mdi-content-add-circle"></i>
    </a>
  </div>
  <!-- Floating Action Button -->
@endsection