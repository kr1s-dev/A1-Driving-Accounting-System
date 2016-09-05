@extends('master_layout.master_page_layout')
@section('content')
  <div class="container">
    <div class="section">
			<div id="table-datatables">
      	<h4 class="header">A1 Driving 
                  Statement of Cash Flow
                  For the Year Ended {{date('M t',strtotime($yearFilter . '-'. '12'))}}, {{$yearFilter}}</h4>
      	<div class="row">
        	<div class="col s12 m12 l12">
            	<!--Basic Form-->
    				<div id="basic-form" class="section">
    					<div class="row">
      					<div class="col s12 m12 l12">
      						<div class="card-panel">
        						<div class="row">
        							
        						</div>
        						<br>
          					<div class="row">
            					<div class="col s12 m12 l12">
              					<table class="striped">
                						<thead class="green white-text">
                  						<th colspan="3">
                      						<h1>Cash Flow from Operating Activities</h1>
                  						</th>
                						</thead>
                						<tbody>
                              @if($incTotalSum-$arBalance<=0 && count($expenseList)<=0 )
                                <tr>
                                  <td colspan="3" align="center"><i><strong>No Activity Found</strong></i></td>
                                </tr>
                              @else
                                <tr>
                                  <td colspan="2">Cash Received from Customers </td>
                                  <td align="right"> ₱ {{number_format($incTotalSum-$arBalance,2)}}</td>
                                </tr>
                                @if(count($expenseList)>0)
                                  <tr>
                                    <td colspan="3">Cash Payments For: </td>
                                  </tr>
                                  @foreach($expenseList as $key=>$value)
                                    @if($value > 0)
                                      <tr>
                                        <td>{{str_replace(strpos($key, 'Expense')?'Expense':'Expenses', '', $key)}}</td>
                                        <td align="right">₱ {{number_format($value,2)}}</td>
                                        <td></td>
                                      </tr>
                                    @endif
                                  @endforeach
                                @endif
                              @endif
                              
                						</tbody>
                            <thead class="green white-text">
                              <th colspan="3">
                                  <h1>Cash Flow from Investing Activities</h1>
                              </th>
                            </thead>
                            <tbody>
                              @if(count($investmentList)<=0)
                                <tr>
                                  <td colspan="3" align="center"><i><strong>No Activity Found</strong></i></td>
                                </tr>
                              @else
                                @foreach($investmentList as $key => $value)
                                  @if($value != 0)
                                    <tr>
                                      <td>Acquisition of {{$key}}</td>
                                      <td align="right">₱ {{number_format($value,2)}}</td>
                                      <td></td>
                                    </tr>
                                  @endif
                                @endforeach
                              @endif
                            </tbody>
                            <thead class="green white-text">
                              <th colspan="3">
                                  <h1>Cash Flow from Financing Activities</h1>
                              </th>
                            </thead>
                            </thead>
                            <tbody>
                              @if(count($financingList)<=0)
                                <tr>
                                  <td colspan="3" align="center"><i><strong>No Activity Found</strong></i></td>
                                </tr>
                              @else
                                @foreach($financingList as $key => $value)
                                  @if($value != 0)
                                    <tr>
                                      <td colspan="2">{{$key}}</td>
                                      <td align="right">₱ {{number_format($value,2)}}</td>
                                    </tr>
                                  @endif
                                @endforeach
                              @endif
                            </tbody>

                						<tfoot>
                    						<th style="text-align: right" colspan="3">
                        						Total Cash in Hand: ₱ {{number_format($totalCashInHand,2)}}
                    						</th>
                						</tfoot>
              					</table>
            					</div>
          					</div>
          					<br><br>
          					<div class="row">
                      <div class="input-field col s12">
                          {!! Form::open(['url'=>'pdf','method'=>'POST','target'=>'_blank','class'=>'col s12']) !!}
                            @include('pdf.pdf_form',['category'=>'statement_of_cash_flow_report',
                                                      'recordId'=>null,
                                                      'month_filter'=>null,
                                                      'year_filter'=>$yearFilter])
                          {!! Form::close() !!}
                      </div>
                    </div>
        				  </div>
      			    </div>
    			    </div>
    		    </div>
  		    </div>
	    </div>
    </div>
  </div>
@endsection