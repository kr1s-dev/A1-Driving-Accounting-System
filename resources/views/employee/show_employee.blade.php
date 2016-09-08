@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
  	<div class="container">
    	<div class="section">
      		<!--DataTables example-->
  			<div id="table-datatables">
    			<h4 class="header">{{sprintf("%'.07d\n", $employee->id)}} | {{$employee->employee_first_name}}&nbsp;{{$employee->employee_middle_name}}&nbsp;{{$employee->employee_last_name}}</h4>
    			<div class="row">
      				<div class="col s12 m12 l12">
        				<!--Basic Form-->
        				<div id="basic-form" class="section">
        					<div class="row">
          					<div class="col s12 m12 l12">
          						<div class="card-panel">
                        <div class="row">
                          <div class="col l6 m6 s12">
                            <h4 class="header2">Employee Information</h4>
                          </div>
                          <div class="col l6 m6 s12">
                            <a href="{{route('employee.edit',$employee->id)}}" class="btn waves-effect waves-light cyan right" type="submit" name="action">Update Employee
                              <i class="mdi-action-receipt right"></i>
                            </a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee First Name</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_first_name}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Middle Name</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_middle_name}}</h6>
                          </div>
              				</div>
                      <div class="divider"></div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Last Name</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_last_name}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Email Address</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_email}}</h6>
                          </div>
                      </div>
                      <div class="divider"></div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Position</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_position}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Salary</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->employee_salary}}</h6>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>Added Source of Salary (Taxable)</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->added_source_of_salary_taxable}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Added Source of Salary (Non-Taxable)</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->added_source_of_salary_non_taxable}}</h6>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>SSS deductions</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->employee_sss_deduction}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Philhealth Deductions</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->employee_philhealth_deduction}}</h6>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>PagIbig Deductions</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->employee_pagibig_deduction}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Other Deductions</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>₱ {{$employee->other_deduction}}</h6>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col l3 m3 s12">
                            <h6><strong>Employee Status</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->tax_status}}</h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6><strong>Tax</strong></h6>
                          </div>
                          <div class="col l3 m3 s12">
                            <h6>{{$employee->employee_withholding_tax}}</h6>
                          </div>
                      </div>

                      <div class="divider"></div>
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