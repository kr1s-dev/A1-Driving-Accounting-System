@extends('master_layout.master_page_layout')
@section('content')
  <!--start container-->
    <div class="container">
      <div class="section">
     <!--DataTables example-->
        <div id="table-datatables">
          <h4 class="header">View All Students</h4>
          <div class="row">
            <div class="col s12 m12 l12">
              <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                <thead>
                    <tr>
                      <th>Employee No.</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Gross Salary</th>
                      <th>Actions</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                      <th>Employee No.</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Gross Salary</th>
                      <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                  @if(!(empty($employeeList)))
                    @foreach($employeeList as $employee)
                      <tr>
                        <td><a href="{{route('employee.show',$employee->id)}}">{{sprintf("%'.07d\n", $employee->id)}}</a></td>
                        <td>{{$employee->employee_first_name}}</td>
                        <td>{{$employee->employee_middle_name}}</td>
                        <td>{{$employee->employee_last_name}}</td>
                        <td>{{$employee->employee_email}}</td>
                        <td>{{$employee->employee_salary}}</td>
                        <td class="center-align">
                          <a href="{{route('employee.edit',$employee->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                            <i class="mdi-content-create"></i>
                          </a>
                          @if($employee->is_active)
                            {!! Form::model($employee, ['method'=>'DELETE','action' => ['Employee\EmployeeController@destroy',$employee->id] , 'class' => 'col s12']) !!}
                            <button type="submit" class="btn-floating waves-effect waves-light grey darken-4"><i class="mdi-action-lock"></i> </button>
                            {!! Form::close() !!}
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
      <a href="{{route('employee.create')}}" class="btn-floating btn-large red darken-2">
        <i class="mdi-content-add-circle"></i>
      </a>
  </div>
  <!-- Floating Action Button -->
  <!--end container-->
@endsection