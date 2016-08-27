@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
    <div class="section">
			<div id="table-datatables">
        <h4 class="header">Asset Registry as of
                    {{date('F')}}, {{date('Y')}}
        </h4>
        <div class="row">
          <div class="col s12 m12 l12">
            <!--Basic Form-->
            	<div id="basic-form" class="section">
              	<div class="row">
                	<div class="col s12 m12 l12">
                  	<div class="card-panel">
                    	<br>
                      <div class="row">
              					<div class="col s12 m12 l6">
                					<table class="striped">
                						<thead class="green white-text">
                  						<tr>
                                <th>Asset No#</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Monthly Depreciation</th>
                                <th>Accumulated Depreciation</th>
                                <th>Remaining Months</th>
                                <th>Net Amount</th>
                              </tr>
                						</thead>
                						<tbody>
                  						@if(count($assetItemList)<=0)
                                <tr><td colspan="7" align="center"><em><strong> No Records Found </strong></em></td></tr>
                              @else
                                @foreach($assetItemList as $assetItem)
                                  <tr>
                                    <td><a href="{{route('assets.show',$assetItem->id)}}"><em><strong>{{sprintf("%'.07d\n", $assetItem->id)}}</strong></em></a></td>
                                    <td>{{$assetItem->item_name}}</td>
                                    <td>{{number_format($assetItem->quantity,2)}}</td>
                                    <td>PHP {{number_format($assetItem->monthly_depreciation,2)}}</td>
                                    <td>PHP {{number_format($assetItem->accumulated_depreciation,2)}}</td>  
                                    <td>{{$assetItem->useful_life}}</td>
                                    <td>{{$assetItem->net_value}}</td>  
                                  </tr>
                                @endforeach
                              @endif
                						</tbody>
                					</table>
              					</div>		
            					</div>
            					<br><br>
            					<div class="row">
              						<div class="input-field col s12">
                						<button class="btn red darken-2 waves-effect waves-light right" type="submit" name="action" style="margin-left:10px;">
                  					<i class="material-icons left">picture_as_pdf</i> Generate PDF
                				</button>
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