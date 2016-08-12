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

                        <h6>
                          @if($student->userCreateInfo->branch_id != NULL)
                            {{$student->userCreateInfo->branchInfo->branch_name}}
                          @else
                            No Branch
                          @endif
                        </h6>
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
                        <a href="{{route('student.invoice',$student->id)}}" class="btn waves-effect waves-light cyan" type="submit" name="action">Create New Invoice
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
                          @if(count($student->invoiceInfo)>0)
                            @foreach($student->invoiceInfo as $invoice)
                              @if($invoice->is_paid)
                                @foreach($invoice->invoiceItemsInfo as $invoiceItems)
                                  @if($invoiceItems->accountTitleInfo->account_title_name == 'Course Fee'
                                      || strpos($invoiceItems->accountTitleInfo->account_title_name,'Course Fee'))
                                      <tr>
                                        <td>{{date('m-d-Y',strtotime($invoiceItems->created_at))}}</td>
                                        <td>-</td>
                                        <td>₱ {{$invoiceItems->amount}}</td>
                                        <td>[Under Construction]</td>
                                        <td>[Under Construction]</td>
                                        <td>[Under Construction]</td>
                                      </tr>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          @else
                            <tr>
                              <td colspan="6" style="text-align: center;"><em><strong> No Records Found </strong></em></td>
                            </tr>
                          @endif
                          
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
                          @if(count($student->invoiceInfo)>0)
                            @foreach($student->invoiceInfo as $invoice)
                              @if($invoice->is_paid)
                                @foreach($invoice->invoiceItemsInfo as $invoiceItems)
                                  @if($invoiceItems->accountTitleInfo->account_title_name != 'Course Fee'
                                      && !strpos($invoiceItems->accountTitleInfo->account_title_name,'Course Fee'))
                                      <tr>
                                        <td>{{date('m-d-Y',strtotime($invoiceItems->created_at))}}</td>
                                        <td>-</td>
                                        <td>₱ {{$invoiceItems->amount}}</td>
                                        <td>[Under Construction]</td>
                                        <td>[Under Construction]</td>
                                        <td>[Under Construction]</td>
                                      </tr>
                                  @else
                                    <tr>
                                      <td colspan="5" style="text-align: center;"><em><strong> No Records Found </strong></em></td>
                                    </tr>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          @else
                            <tr>
                              <td colspan="5" style="text-align: center;"><em><strong> No Records Found </strong></em></td>
                            </tr>
                          @endif
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