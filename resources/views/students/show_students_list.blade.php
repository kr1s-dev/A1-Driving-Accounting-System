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
                      <th>Control No.</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile No.</th>
                      <th>Actions</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                      <th>Control No.</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile No.</th>
                      <th>Actions</th>
                    </tr>
                    </tr>
                </tfoot>
                <tbody>
                  @foreach($studentList as $student)
                    <tr>
                      <td><a href="{{route('students.show',$student->id)}}">{{sprintf("%'.07d\n", $student->id)}}</a></td>
                      <td>{{$student->stud_first_name}}</td>
                      <td>{{$student->stud_last_name}}</td>
                      <td>{{$student->stud_email}}</td>
                      <td>{{$student->stud_mobile_no}}</td>
                      <td class="center-align">
                        <a href="{{route('students.edit',$student->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                          <i class="mdi-content-create"></i>
                        </a>
                        <!--a class="btn-floating waves-effect waves-light grey darken-4">
                          <i class="mdi-action-lock"></i>
                        </a-->
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
      <a href="{{route('students.create')}}" class="btn-floating btn-large red darken-2">
        <i class="mdi-content-add-circle"></i>
      </a>
  </div>
  <!-- Floating Action Button -->
  <!--end container-->
@endsection