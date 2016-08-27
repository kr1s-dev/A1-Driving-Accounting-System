<!DOCTYPE html>
<html lang="en">
  	<head>
  	</head>
  	<body>
       	<div align="center">
		     <p><strong>A1 Driving School</strong></p>
		     <p>Balance Sheet </p>
		     <p>For 
		     	@if(empty($monthFilter))
		     		Year End {{$yearFilter}}
		     	@else
		     		Month End {{date('F',strtotime($monthFilter))}},{{$yearFilter}}
		     	@endif
		     </p>
		</div>
		<hr/>
		<table style="width:100%; border-collapse: collapse;">
			<tr>
		        <th colspan="3" align="left"><h3><strong>ASSETS</strong></h3></th>
		    </tr>
		    @foreach($fBalanceSheetItemsList as $key => $value)
      			@if(strpos($key, 'Assets') !== false)
      				<tr>
      					<td colspan="3">
      						<strong>{{$key}}</strong>
      					</td>
      				</tr>
      				@foreach($value as $key => $val)
      				<tr>
      					<td align="center" width="30%">{{$key}}</td>
      					<td width="35%" align="right">
      						@if($val>=0)
          						PHP {{number_format($val,2)}}
          					@else
          						(PHP {{number_format(($val*-1),2)}})
          					@endif
          				</td>
          				<td align="right" width="35%"></td>
      				</tr>
      				@endforeach
      			@endif
      		@endforeach
      		<tr>
      			<td width="30%"><strong>Total Assets:<strong></td>
				<td width="35%" align="right"> <u>
					@if($totalAssets>=0)
						PHP {{number_format($totalAssets,2)}}
					@else
						(PHP {{number_format(($totalAssets*-1),2)}})
					@endif
					</u>
				</td>
				<td align="right" width="35%"></td>
      		</tr>
      		<tr>
				<td colspan="2"></td>
				<td align="right"></td>
	  		</tr>
	  	</table>
	  	<table style="width:100%; border-collapse: collapse;">
      		<tr>
	          	<th colspan="3" align="left"><h3><strong>LIABILITIES AND OWNERS EQUITY</strong></h3></th>
	        </tr>
	        @foreach($fBalanceSheetItemsList as $key => $value)
	  			@if(strpos($key, 'Liabilities'))
	  				<tr>
      					<td colspan="3">
      						<strong>{{$key}}</strong>
      					</td>
      				</tr>
	  				@foreach($value as $k => $val)
	  				<tr>
	  					<td align="center" width="30%">{{$k}}</td>
	  					<td align="right" width="35%"></td>
      					<td width="35%" align="right">
      						@if($val>=0)
          						PHP {{number_format($val,2)}}
          					@else
          						(PHP {{number_format(($val*-1),2)}})
          					@endif
          				</td>
	  				</tr>
	  				@endforeach
	  			@endif
	  		@endforeach
	  		<tr>
				<td> <strong> Total Liabilities </strong></td>
				<td align="right" width="35%"></td>
				<td width="35%" align="right">
					@if($totalLiability>=0)
						PHP {{number_format($totalLiability,2)}}
					@else
						(PHP {{number_format(($totalLiability*-1),2)}})
					@endif
				</td>
	  		</tr>
  		</table>
  		<table style="width:100%; border-collapse: collapse;">
	        @foreach($fBalanceSheetItemsList as $key => $value)
	  			@if(strpos($key, 'Equity'))
	  				<tr>
      					<td colspan="3">
      						<strong>{{$key}}</strong>
      					</td>
      				</tr>
	  				@foreach($value as $k => $val)
	  				<tr>
	  					<td align="center" width="30%">{{$k}}</td>
	  					<td align="right" width="35%"></td>
      					<td width="35%" align="right">
      						@if($val>=0)
          						PHP {{number_format($val,2)}}
          					@else
          						(PHP {{number_format(($val*-1),2)}})
          					@endif
          				</td>
	  				</tr>
	  				@endforeach
	  			@endif
	  		@endforeach
	  		<tr>
				<td> <strong> Total Equity </strong></td>
				<td align="right" width="35%"></td>
				<td width="35%" align="right">
					@if($totalEquity>=0)
						PHP {{number_format($totalEquity,2)}}
					@else
						(PHP {{number_format(($totalEquity*-1),2)}})
					@endif
				</td>
	  		</tr>
	  		<tr>
				<td> <strong> Total Equity and Liabilities </strong></td>
				<td align="right" width="35%"></td>
				<td width="35%" align="right"> <u>
					@if(($totalLiability + $totalEquity)>=0)
						PHP {{number_format($totalLiability + $totalEquity,2)}}
					@else
						(PHP {{number_format((($totalLiability + $totalEquity)*-1),2)}})
					@endif
					</u>
				</td>
	  		</tr>
  		</table>
  	</body>
</html>