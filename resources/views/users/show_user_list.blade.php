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
                  @foreach($userList as $user)
                    <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile_number}}</td>
                        <td>{{$user->userType->type}}</td>
                        <td class="center-align">
                          <a href="{{route('user.edit',$user->id)}}"style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                            <i class="mdi-content-create"></i>
                          </a>
                          <a class="btn-floating waves-effect waves-light grey darken-4">
                            <i class="mdi-action-lock"></i>
                          </a>
                        </td>
                    </tr>
                  @endforeach
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