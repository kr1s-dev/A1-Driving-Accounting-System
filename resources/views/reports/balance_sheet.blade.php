@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
    <div class="section">
        <!--DataTables example-->
      <div id="table-datatables">
      	<h4 class="header">Balance Sheet for
      		@if(!empty($monthFilter))
        	{{date('F',strtotime($monthFilter))}}, 
        @endif 
        {{$yearFilter}}
      	</h4>
      	<div class="row">
        	<div class="col s12 m12 l12">
            <!--Basic Form-->
    			<div id="basic-form" class="section">
      			<div class="row">
        			<div class="col s12 m12 l12">
          			<div class="card-panel">
            			<div class="row">
              			{!! Form::open(['url'=>'reports/balancesheet','method'=>'POST']) !!}
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
            	  </div>
                <div class="row">
                  <div class="col s12 m12 l6">
                    <table class="bordered responsive-table">
                      <thead class="green white-text">
                        <th colspan="2">
                          <h1>Assets</h1>
                        </th>
                      </thead>
                      <tbody>
                        @foreach($fBalanceSheetItemsList as $key => $value)
		              			  @if(strpos($key, 'Assets') !== false)
		              				  <tr>
		              					  <td colspan="2">
		              						  <strong>{{$key}}</strong>
		              					  </td>
		              				  </tr>
		              				  @foreach($value as $key => $val)
		              				    <tr>
		              					    <td>{{$key}}</td>
		              					    <td style="text-align: right">
  		              						  @if($val>=0)
  			              						  ₱ {{number_format($val,2,'.',',')}}
  			              					  @else
  			              						  (₱ {{number_format(($val*-1),2,'.',',')}})
  			              					  @endif
			              				   </td>
		              				    </tr>
		              				  @endforeach
		              			  @endif
		              		  @endforeach
                        <tr class="green">
                          <td>
                        		<strong>Total Assets</strong>
                      	  </td>
                      	  <td style="text-align: right">
                         		<strong>₱ {{number_format($totalAssets,2,'.',',')}}</strong>
                      	  </td>
                    	  </tr>
                	    </tbody>
                    </table>
                  </div>

                  <div class="col s12 m12 l6">
                  	<table class="striped">
                  		<thead class="red white-text">
                    		<th colspan="2">
                        	<h1>Liabilities and Owner's Equity</h1>
                    		</th>
                  		</thead>
                    	<tbody>
                        @foreach($fBalanceSheetItemsList as $key => $value)
		              			  @if(strpos($key, 'Liabilities') !== false || strpos($key, 'Equity') !== false)
		              				<tr>
		              					<td colspan="2">
		              						<strong>{{$key}}</strong>
		              					</td>
		              				</tr>
		              				@foreach($value as $k => $val)
		              				<tr>
		              					<td>{{$k}}</td>
		              					<td style="text-align: right">
		              						@if($val>=0)
			              						₱ {{number_format($val,2,'.',',')}}
			              					@else
			              						(₱ {{number_format(($val*-1),2,'.',',')}})
			              					@endif
			              				</td>
		              				</tr>
		              				@endforeach
		              				<tr>
		              					@if(strpos($key, 'Fixed Liabilities') !== false)
		              						<td> <strong> Total Liabilities </strong></td>
				              				<td style="text-align: right"> ₱ {{number_format($totalLiability,2,'.',',')}} </td>
		              					@elseif(strpos($key, 'Equity') !== false)
		              						<td> <strong> Total Equity </strong></td>
				              				<td style="text-align: right"> ₱ {{number_format($totalEquity,2,'.',',')}} </td>
		              					@endif
				              		</tr>
		              			@endif
		              		@endforeach
                  		<tr class="red">
                    		<td>
                      			<strong>Total Equity and Liabilities</strong>
                    		</td>
                    		<td style="text-align: right">
                       			<strong>₱ {{number_format($totalLiability + $totalEquity,2,'.',',')}}</strong>
                    		</td>
                  		</tr>
              		  </tbody>
                  </table>
                </div>
              </div>
              <br><br>
            	<div class="row">
              	<div class="input-field col s12">
                	{!! Form::open(['url'=>'pdf','method'=>'POST','target'=>'_blank','class'=>'col s12']) !!}
                    @include('pdf.pdf_form',['category'=>'balance_sheet_report',
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
  </div
@endsection