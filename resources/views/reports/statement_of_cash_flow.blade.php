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
                              <tr>
                                <td>
                                  Total Profit
                                </td>
                                @if($totalProfit>0)
                                  <td colspan="2" align="right">PHP {{number_format($totalProfit,2,'.',',')}}</td>
                                @else
                                  <td colspan="2" align="left">PHP {{number_format($totalProfit,2,'.',',')}}</td>
                                @endif
                              </tr>
                              <tr>
                                <td colspan="3">
                                  Adjustments for:
                                </td>
                              </tr>
                              @if($depreciationValue != 0)
                                <tr>
                                  <td>
                                    Depreciation and Amortization
                                  </td>
                                  <td colspan="2" align="right">PHP {{number_format($depreciationValue,2,'.',',')}}</td>
                                </tr>
                              @endif
                              @foreach($accountTitleList as $key => $value)
                                @if($key == 'Current Assets')
                                  @foreach($value as $val)
                                    @if($val->account_title_name != 'Cash')
                                      @if($val->opening_balance < 0 )
                                        @if($key == 'Current Assets')
                                          <tr>
                                            <td>Decrease on {{$val->account_title_name}}</td>
                                            <td colspan="2" align="left">PHP {{number_format($val->opening_balance,2,'.',',')}}</td>
                                          </tr>
                                        @else
                                          <tr>
                                            <td>Increase on {{$val->account_title_name}}</td>
                                            <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                          </tr>
                                        @endif
                                      @elseif($val->opening_balance > 0 )
                                        @if(strrpos($key, 'Asset'))
                                          <tr>
                                            <td>Increase on {{$val->account_title_name}}</td>
                                            <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                          </tr>
                                        @else
                                          <tr>
                                            <td>Decrease on {{$val->account_title_name}}</td>
                                            <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                          </tr>
                                        @endif
                                      @endif
                                    @endif
                                  @endforeach
                                @endif
                              @endforeach
                              <tr>
                                <td colspan="2"> <strong>Cash generated from operations</strong></td>
                                <td><u>PHP {{($totalProfit+$totalOperationCash+$depreciationValue)}}</u></td>
                              </tr>
                            </tbody>
                            <thead class="green white-text">
                              <th colspan="3">
                                  <h1>Cash Flow from Investing Activities</h1>
                              </th>
                            </thead>
                            <tbody>
                              @foreach($tThisYearsBalanceSht as $key)
                                @if($key->asset_id != NULL)
                                  <tr>
                                    @if($key->credit_title_id != NULL && $key->credit->account_title_name == 'Cash')
                                      <td>Purchase of {{$key->asset->accountTitleInfo->account_title_name}}</td>
                                      <td colspan="2" align="left">PHP {{$key->credit_amount}}</td>
                                    @endif
                                  </tr>
                                @endif
                              @endforeach
                              <tr>
                                <td colspan="2"> <strong>Net cash used in investing activities</strong></td>
                                <td><u>PHP {{($totalInvestmentCash)}}</u></td>
                              </tr>
                            </tbody>
                            <thead class="green white-text">
                              <th colspan="3">
                                  <h1>Cash Flow from Financing Activities</h1>
                              </th>
                            </thead>
                            </thead>
                            <tbody>
                              @foreach($accountTitleList as $key => $value)
                                @if(strpos('x' . $key, 'Non-Current Liabilities'))
                                  @foreach($value as $val)
                                    @if(strrpos('x'.$val->account_title_name,'Loans'))
                                      @if($val->opening_balance < 0 )
                                        <tr>
                                          <td>Paid: {{$val->account_title_name}}</td>
                                          <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                        </tr>
                                      @elseif($val->opening_balance > 0 )
                                        <tr>
                                          <td>Borrowed from: {{str_replace('Loans', '', $val->account_title_name)}}</td>
                                          <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                        </tr>
                                      @endif
                                    @endif
                                    
                                  @endforeach
                                @endif
                              @endforeach

                              @foreach($accountTitleList as $key => $value)
                                @if(strpos('x' . $key, 'Equity'))
                                  @foreach($value as $val)
                                    @if($val->opening_balance < 0 )
                                      <tr>
                                        <td>Decrease: {{$val->account_title_name}}</td>
                                        <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                      </tr>
                                    @elseif($val->opening_balance > 0 )
                                      <tr>
                                        <td>Increase in: {{$val->account_title_name}}</td>
                                        <td colspan="2" align="left">PHP {{$val->opening_balance}}</td>
                                      </tr>
                                    @endif
                                  @endforeach
                                @endif
                              @endforeach
                              <tr>
                                <td colspan="2"> <strong>Net cash used in financing activities</strong></td>
                                <td><u>PHP {{($totalFinancingCash)}}</u></td>
                              </tr>
                            </tbody>

                						<tfoot>
                    						<th style="text-align: right" colspan="3">
                        						Total Cash in Hand: ₱ {{number_format(($totalProfit+$totalOperationCash)-$totalInvestmentCash+$totalFinancingCash+$depreciationValue,2,'.',',')}}
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