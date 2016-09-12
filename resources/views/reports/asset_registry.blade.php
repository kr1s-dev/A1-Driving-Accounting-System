@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
    <div class="section">
			<div id="table-datatables">
        <h4 class="header">Asset Registry as of
                    {{date('F')}} {{date('Y')}}
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
              					<div class="col s12 m12 l12">
                					<table class="striped">
                						<thead class="green white-text">
                  						<tr>
                                <th style="border-radius: 0;">Asset No#</th>
                                <th style="border-radius: 0;">Item Name</th>
                                <th style="border-radius: 0;">Monthly Depreciation</th>
                                <th style="border-radius: 0;">Accumulated Depreciation</th>
                                <th style="border-radius: 0;">Remaining Months</th>
                                <th style="border-radius: 0;">Net Amount</th>
                              </tr>
                						</thead>
                						<tbody>
                  						@if(count($assetItemList)<=0)
                                <tr><td colspan="7" align="center"><em><strong> No Records Found </strong></em></td></tr>
                              @else
                                @foreach($assetItemList as $assetItem)
                                  <tr>
                                    <td><a href="{{route('asset.show',$assetItem->id)}}"><em><strong>{{sprintf("%'.07d\n", $assetItem->id)}}</strong></em></a></td>
                                    <td>{{$assetItem->asset_name}}</td>
                                    <td>PHP {{number_format($assetItem->monthly_depreciation,2)}}</td>
                                    <td>PHP {{number_format($assetItem->accumulated_depreciation,2,'.',',')}}</td>  
                                    <td>{{$assetItem->asset_lifespan}} mo/s</td>
                                    <td>PHP {{number_format($assetItem->net_value,2,'.',',')}}</td>  
                                  </tr>
                                @endforeach
                              @endif
                              <tr>
                                <td style=" color: #fff;background: #e53935;text-align: right" colspan="5">Grand Total</td>
                                <td style="background: #eee;">PHP {{number_format($totalNetValue,2,'.',',')}} </td>
                              </tr>
                						</tbody>
                					</table>
              					</div>		
            					</div>
            					<br><br>
            					<div class="row">
              						<div class="input-field col s12">
                						{!!Form::open(['url'=>'pdf','method'=>'POST','target'=>'_blank']) !!}
                              @include('pdf.pdf_form',['category'=>'asset_registry_report',
                                              'recordId'=>null,
                                              'month_filter'=>null,
                                              'year_filter'=>null,
                                              'type'=>null])
                            {!! Form::close() !!}
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