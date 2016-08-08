@extends('master_layout.master_page_layout')
@section('content')
  
  <!--start container-->
  <div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <h4 class="header">{{sprintf("%'.07d\n", $student->id)}} | {{$student->stud_first_name}}&nbsp;{{$student->stud_last_name}}</h4>
        <div class="row">
          <div class="col s12 m12 l12">
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <h4 class="header2">Student Information</h4>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Branch Enrolled</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->userCreateInfo->branchInfo->branch_name}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Training Station</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->branchInfo->branch_name}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Mobile No.</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_contact_mobile_no}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Tel. No.</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_tel_no}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Address</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_address}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Email</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_email}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Vehicle</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_vehicle}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Date of Birth</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{date('m-d-Y',strtotime($student->stud_date_of_birth))}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Birthplace</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_birth_place}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Age</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>0</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Nationality</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_nationality}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Marital Status</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_marital_status}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Gender</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_gender}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Occupation</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_occupation}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Company</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_company}}</h6>
                      </div>
                    </div>
                  </div>
                  <div class="card-panel">
                    <h4 class="header2">In Case of Emergency, Contact: </h4>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Name</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_contact_name}}</h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6><strong>Mobile No.</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_contact_mobile_no}}</h6>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                      <div class="col l3 m3 s12">
                        <h6><strong>Tel. No.</strong></h6>
                      </div>
                      <div class="col l3 m3 s12">
                        <h6>{{$student->stud_contact_tel_no}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col l12 m12 s12">
                  <div class="card-panel">
                    <h4 class="header2">Payment Information </h4>
                    <div class="row right-align">
                      <div class="col l12 m12 s12">
                        <a href="../invoices/create.html" class="btn waves-effect waves-light cyan" type="submit" name="action">Create New Invoice
                          <i class="mdi-action-receipt right">
                          </i>
                        </a>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <table class="striped">
                        <thead>
                          <tr>
                            <td colspan="6" class="grey darken-3 white-text center-align">Course Fee</td>
                          </tr>
                          <tr>
                             <th>Date</th>
                             <th>OR#</th>
                             <th>Amount in PHP</th>
                             <th>Payment Type</th>
                             <th>Mode of Payment</th>
                             <th>Outstanding Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>07/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Downpayment</td>
                            <td>Cash</td>
                            <td>₱3,000</td>
                          </tr>
                          <tr>
                            <td>06/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Downpayment</td>
                            <td>Cash</td>
                            <td>₱6,000</td>
                          </tr>
                          <tr>
                            <td>05/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Downpayment</td>
                            <td>Cash</td>
                            <td>₱9,000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="row">
                      <table class="striped bordered">
                        <thead>
                          <tr>
                            <td colspan="5" class="grey darken-3 white-text center-align">Other Fees</td>
                          </tr>
                          <tr>
                             <th>Date</th>
                             <th>OR#</th>
                             <th>Amount in PHP</th>
                             <th>Payment Type</th>
                             <th>Mode of Payment</th> 
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>07/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Student Permit</td>
                            <td>Cash</td>
                          </tr>
                          <tr>
                            <td>06/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Driver's Manual</td>
                            <td>Cash</td>
                          </tr>
                          <tr>
                            <td>05/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Downpayment</td>
                            <td>Cash</td>
                          </tr>
                          <tr>
                            <td>05/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Non-Pro/Pro</td>
                            <td>Cash</td>
                          </tr>
                          <tr>
                            <td>05/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Int't License</td>
                            <td>Cash</td>
                          </tr>
                          <tr>
                            <td>05/29/2016</td>
                            <td>0001</td>
                            <td>₱3,000</td>
                            <td>Certificate</td>
                            <td>Cash</td>
                          </tr>
                        </tbody>
                      </table>
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