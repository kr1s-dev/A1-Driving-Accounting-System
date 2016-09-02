@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
   	<div class="container account-information">
      	<div class="section">
          	<div class="row">
            	<div class="col s12 m12 l12">
              		<div class="card  light-blue">
                		<div class="card-content white-text">
                  			<span class="card-title">Account Details</span>
              				<div class="row">
                        @if(Auth::user()->userType->type=='Administrator' || (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office))
                          <div class="col l2"><h6>Name</h6></div>
                          <div class="col l4"><h5>A1 Driving School Accounting</h5></div>
                        @else
                          <div class="col l2"><h6>Branch</h6></div>
                          <div class="col l4"><h5>{{Auth::user()->branchInfo->branch_name}}</h5></div>
                        @endif
			                    <div class="col l2"><h6>Calendar Year</h6></div>
			                    <div class="col l4"><h5>{{$dateToday}} - {{$dateNextYear}}</h5></div>
              				</div>
                		</div>
              		</div>
            	</div>
          	</div>

          	<div class="row">
            	<div class="col s12 m12 l12">
              		<div class="card green">
                		<div class="card-content white-text">
                  			<span class="card-title">Account Summary</span>
                  			<div class="row">
			                    <div class="col l2"><h6>Assets</h6></div>
			                    <div class="col l4">
                            <h5>
                                @if($assetTotal<0)
                                  DR ₱ {{number_format($assetTotal,2)}}
                                @else
                                  DR ₱ {{number_format($assetTotal,2)}}
                                @endif
                            </h5></div>
			                    <div class="col l2"><h6>Liabilities</h6></div>
			                    <div class="col l4">
                            <h5>
                                @if($liabilitiesTotal<0)
                                  DR ₱ {{number_format(($liabilitiesTotal*-1),2)}}
                                @else
                                  CR ₱ {{number_format($liabilitiesTotal,2)}}
                                @endif
                            </h5>
                          </div>
			                    <div class="col l2"><h6>Income</h6></div>
			                    <div class="col l4">
                            <h5>
                              @if($incomeTotal<0)
                                DR ₱ {{number_format(($incomeTotal*-1),2)}}
                              @else
                                CR ₱ {{number_format($incomeTotal,2)}}
                              @endif
                            </h5>
                          </div>
			                    <div class="col l2"><h6>Expenses</h6></div>
			                    <div class="col l4"><h5>
                            <h5>
                              @if($expenseTotal<0)
                                DR ₱ {{number_format(($expenseTotal*-1),2)}}
                              @else
                                CR ₱ {{number_format($expenseTotal,2)}}
                              @endif
                            </h5>
                          </div>
                  			</div>
                		</div>
              		</div>
            	</div>
          	</div>
      	</div>
   	</div>
	<!--end container-->
@endsection