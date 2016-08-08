@extends('master_layout.master_page_layout')
@section('content')
  
  <!--start container-->
  <div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <h4 class="header">Edit Branch</h4>
        <div class="row">
          <div class="col s12 m12 l12">
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <h4 class="header2">Branch Information</h4>
                    <div class="row">
                      {!! Form::model($branch, ['method'=>'PATCH','action' => ['Branches\BranchController@update',$branch->id] , 'class' => 'col s12']) !!}
                          @include('branches.branches_form',['submitButton'=>'Update Branch']);
                      {!! Form::close() !!}
                      <form class="col s12">
                      </form>
                    </div>
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