@extends('master_layout.master_page_layout')
@section('content')
  <div class="container">
    <div class="section">
			<div id="table-datatables">
      	<h4 class="header">Income Statement for
        	@if(!empty($monthFilter))
        		{{date('F',strtotime($monthFilter))}}, 
        	@endif 
        	{{$yearFilter}}</h4>
      	<div class="row">
        	<div class="col s12 m12 l12">
            	<!--Basic Form-->
    				<div id="basic-form" class="section">
    					<div class="row">
      					<div class="col s12 m12 l12">
      						<div class="card-panel">
        						<div class="row">
        							{!! Form::open(['url'=>'reports/incomestatement','method'=>'POST']) !!}
            							<div class="input-field col s3">
              							<select name="month_filter">
              								@foreach(range(1,12) as $month)
			    											<option value="{{$month}}">{{date('F',strtotime('2016-'.$month))}}</option>
			    										@endforeach
              							</select>
              							<label>Month</label>
            							</div>
            							<div class="input-field col s3">
              							<select name="year_filter">
                								<option value="2016">2016</option>
                								<option value="2015">2015</option>
                								<option value="2014">2014</option>
              							</select>
              							<label>Year</label>
            							</div>
            							<div class="input-field col s2">
              							<button class="btn red darken-2 waves-effect waves-light right" type="submit" name="action" style="margin-left:10px;">
                								<i class="material-icons left">filter_list</i> Filter
              							</button>
            							</div>
          						{!! Form::close() !!}
        						</div>
        						<br>
          					<div class="row">
            					<div class="col s12 m12 l6">
              					<table class="striped">
                						<thead class="green white-text">
                  						<th colspan="2">
                      						<h1>Income</h1>
                  						</th>
                						</thead>
                						<tbody>
                  						@foreach($incomeItemsList as $key => $value)
						              			<tr>
						              				<td>
						              					{{$key}}
						              				</td>
						              				<td style="text-align: right">
						              					PHP {{number_format($value,2,'.',',')}}
						              				</td>
						              			</tr>
						              		@endforeach
                						</tbody>
                						<tfoot>
                    						<th style="text-align: right" colspan="2">
                        						Total Amount: ₱ {{number_format($incTotalSum,2,'.',',')}}
                    						</th>
                						</tfoot>
              					</table>
            					</div>

            					<div class="col s12 m12 l6">
              					<table class="striped">
                						<thead class="red white-text">
                  						<th colspan="2">
                      						<h1>Expenses</h1>
                  						</th>
                						</thead>
                						<tbody>
                    						@foreach($expenseItemsList as $key => $value)
							              			<tr>
							              				<td>
							              					{{$key}}
							              				</td>
							              				<td style="text-align: right">
							              					PHP {{number_format($value,2,'.',',')}}
							              				</td>
							              			</tr>
							              		@endforeach
                						</tbody>
                						<tfoot>
                    						<th style="text-align: right" colspan="2">
                        						Total Amount: ₱ {{number_format($expTotalSum,2,'.',',')}}
                    						</th>
                						</tfoot>
              					</table>
            					</div>
          					</div>
          					<br><br>
          					<div class="row">
                      <div class="input-field col s12">
                          {!! Form::open(['url'=>'pdf','method'=>'POST','target'=>'_blank','class'=>'col s12']) !!}
                            @include('pdf.pdf_form',['category'=>'income_statement_report',
                                                      'recordId'=>null,
                                                      'month_filter'=>$monthFilter,
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