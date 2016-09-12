<!DOCTYPE html>
<html lang="en">
  	<head>
      <style>
        body {
          font-family: "Open Sans", "Arial", "Calibri", sans-serif;
          font-size: 12px;
        }
        .header p{
          margin: 5px;
        }
        th {
          background: #eee;
        }
        table, th, td {
          border: 1px solid #000;
          padding: 5px;
        }
      </style>
  	</head>
  	<body>
       	<div class="header" align="center">
		     <p><strong>Somerset Homeowners Association</strong></p>
		     <p>Asset Registry</p>
		     <p>{{date('F')}}, {{date('Y')}} </p>
		  </div>
		<hr/>
		<table cellborder="1" style="width:100%; border-collapse: collapse; text-align:center;">
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
      				<td>PHP {{number_format($assetItem->accumulated_depreciation,2,'.',',')}}</td>  
      				<td>{{$assetItem->asset_lifespan}} mo/s</td>
      				<td>PHP {{number_format($assetItem->net_value,2,'.',',')}}</td>  
        		</tr>
    			@endforeach
	      @endif
          <tr>
            <td style="text-align: right" colspan="4">Grand Total</td>
            <td>PHP {{number_format($totalNetValue,2,'.',',')}} </td>
          </tr>
  	  </tbody>
  	</table>
  </body>
</html>