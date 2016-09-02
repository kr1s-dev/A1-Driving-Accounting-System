<!DOCTYPE html>
<html lang="en">
  	<head>
  	</head>
  	<body>
       	<div align="center">
		     <p><strong>Somerset Homeowners Association</strong></p>
		     <p>Asset Registry</p>
		     <p>{{date('F')}}, {{date('Y')}} </p>
		</div>
		<hr/>
		<table style="width:100%; border-collapse: collapse; text-align:center;">
			<thead>
        <tr>
          	<th>Item Name</th>
          	<th>Monthly Depreciation</th>
          	<th>Accumulated Depreciation</th>
          	<th>Remaining Months</th>
          	<th>Net Amount</th>
        </tr>
  	  </thead>
  	  <tbody>
    		@if(!(empty($assetItemList)))
  				@foreach($assetItemList as $assetItem)
    				<tr>
    					<td>{{$assetItem->asset_name}}</td>
      				<td>PHP {{number_format($assetItem->monthly_depreciation,2)}}</td>
      				<td>PHP {{number_format($assetItem->accumulated_depreciation,2)}}</td>  
      				<td>{{$assetItem->asset_lifespan}} mo/s</td>
      				<td>PHP {{$assetItem->net_value}}</td>  
        		</tr>
    			@endforeach
	      @endif
  	  </tbody>
  	</table>
  </body>
</html>