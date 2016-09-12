@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
  		<div class="section">
     		<!--DataTables example-->
     		<div id="table-datatables">
        		<h4 class="header">View All Assets</h4>
        		<div class="row">
           			<div class="col s12 m12 l12">
              			<table id="data-table-simple" class="responsive-table display" cellspacing="0">
                 			<thead>
			                    <tr>
			                       <th>Asset No.</th>
			                       <th style="width: 20%;">Asset Name</th>
			                       <th>Date Acquired</th>
			                       <th style="width: 20%;">Vendor</th>
			                       <th style="width: 10%;">Original Cost</th>
			                       <th style="width: 2%;">Lifespan (mo/s)</th>
			                       <th style="width: 2%;">Monthly Depreciation</th>
			                       <th style="width: 10%;">Net Value</th>
			                       <th style="width: 15%;">Actions</th>
			                    </tr>
                 			</thead>
                 			<tfoot>
			                    <tr>
			                       <th>Asset No.</th>
			                       <th>Asset Name</th>
			                       <th>Date Acquired</th>
			                       <th>Vendor</th>
			                       <th>Original Cost</th>
			                       <th>Lifespan (mo/s)</th>
			                       <th>Monthly Depreciation</th>
			                       <th>Net Value</th>
			                       <th>Actions</th>
			                    </tr>
                 			</tfoot>
                 		<tbody>
                 			@if($assetList != NULL)
	                 			@foreach($assetList as $asset)
	                 				<tr>
				                       	<td><a href="{{route('asset.show',$asset->id)}}">#{{sprintf("%'.07d\n",$asset->id)}}</a></td>
				                       	<td>{{$asset->asset_name}}</td>
				                       	<td>{{date('F d, Y',strtotime($asset->asset_date_acquired))}}</td>
				                       	<td>{{$asset->asset_vendor}}</td>
				                       	<td>₱ {{number_format($asset->asset_original_cost,2)}}</td>
				                       	<td>{{$asset->asset_lifespan,2}}</td>
				                       	<td>₱ {{number_format($asset->monthly_depreciation,2)}}</td>
				                       	<td>₱ {{number_format($asset->net_value,2,'.',',')}}</td>
				                       	<td class="center-align">
				                          	<a href="{{route('asset.edit',$asset->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
				                          		<i class="mdi-content-create"></i>
				                          	</a>
				                          	<!--a class="btn-floating waves-effect waves-light grey darken-4">
				                          		<i class="mdi-action-lock"></i>
				                          	</a-->
				                       </td>
				                    </tr>
	                 			@endforeach
	                 		@endif
                 			
                 		</tbody>
              		</table>
           		</div>
        	</div>
     	</div>
     	<br>
  	</div>
  	<!-- Floating Action Button -->
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
     	<a href="{{route('asset.create')}}" class="btn-floating btn-large red darken-2">
     		<i class="mdi-content-add-circle"></i>
     	</a>
    </div>
    <!-- Floating Action Button -->
@endsection