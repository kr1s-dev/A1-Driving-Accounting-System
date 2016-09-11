@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
    <div class="section">
      <!--DataTables example-->
      <div id="table-datatables">
        <h4 class="header">Statement of Changes in Equity for the period
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
            						{!! Form::open(['url'=>'reports/ownersequitystatement','method'=>'POST']) !!}
                					<div class="input-field col s3">
               							<select name="month_filter">
               								@foreach(range(1,12) as $month)
    				        						<option value="{{$month}}">{{date('F',strtotime('2016-'.$month))}}</option>
    										      @endforeach
                  					</select>
                  					<label>Month</label>
	                      	</div>
	                      	<div class="input-field col s3">
	                        	<select>
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
                				<div class="col s12 m12 l12">
                  				<table class="striped">
                    				<tbody>
                    					@if(count($equityItemsList)<=0)
                    						<tr>
		              				        <td>
		              					         Capital
		              				        </td>
		              				        <td style="text-align: right">
		              					         ₱ {{number_format(0,2)}}
		              				        </td>
		              			        </tr>
                    					@else
                      					@foreach($equityItemsList as $key => $value)
                      						<tr>
		              				          <td>
		              					         {{$key}}
		              				          </td>
		              				          <td style="text-align: right">
  		              					         ₱ 
  		              					         @if($value>=0)
  		              						        {{number_format($value,2,'.',',')}}
  		              					         @else
  		              						        ({{number_format(($value*-1),2,'.',',')}})
  		              					         @endif
		              				          </td>
		              			          </tr>
                      					@endforeach
                        			@endif
                        			<tr>
                          			<td>
                            			Profits for the Period
                          			</td>
                          		  <td style="text-align: right">
                            			₱ 
                            			@if($totalProfit>=0)
        	              						{{number_format($totalProfit,2,'.',',')}}
        	              					@else
        	              						({{number_format(($totalProfit*-1),2,'.',',')}})
        	              					@endif
                      					</td>
                    					</tr>
                    				</tbody>
                  					<tfoot>
                    					<th style="text-align: right" colspan="2">
                        					Balance at the end of period: ₱ {{ number_format($eqTotalSum,2,'.',',') }}
                    					</th>
                  					</tfoot>
                  				</table>
                				</div>
              				</div>
              				<br><br>
              				<div class="row">
                        <div class="input-field col s12">
                          {!! Form::open(['url'=>'pdf','method'=>'POST','target'=>'_blank','class'=>'col s12']) !!}
                            @include('pdf.pdf_form',['category'=>'owners_equity_report',
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
    </div>
  </div>
@endsection