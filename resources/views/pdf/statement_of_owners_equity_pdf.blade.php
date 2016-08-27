<!DOCTYPE html>
<html lang="en">
  	<head>
  	</head>
  	<body>
       	<div align="center">
		     <p><strong>A1 Driving School</strong></p>
		     <p>Statement of Changes in Equity </p>
		     <p>For
		     	@if(empty($monthFilter))
		     		Year End {{$yearFilter}}
		     	@else
		     		Month End {{$monthArray[$monthFilter]}},{{$yearFilter}}
		     	@endif
		     </p>
		</div>
		<hr/>
		<table style="width:100%; border-collapse: collapse;">
		    <!-- equity items -->
		    @if(count($equityItemsList)<=0)
				<tr>
			        <td>
				         Capital
			        </td>
			        <td style="text-align: right">
				         PHP {{number_format(0,2)}}
			        </td>
		        </tr>
			@else
				@foreach($equityItemsList as $key => $value)
					<tr>
			          <td>
				         {{$key}}
			          </td>
			          <td style="text-align: right">
					         PHP
					         @if($value>=0)
						        {{number_format($value,2)}}
					         @else
						        ({{number_format(($value*-1),2)}})
					         @endif
			          </td>
		          </tr>
				@endforeach
			@endif
		    <tr>
  				<td>
  					Profits for the period
  				</td>
				@if($totalProfit>0)
					<td  align="right" width="35%">PHP {{number_format($totalProfit,2)}}</td>
	        		<td  width="35%"></td>
				@else
					<td  width="35%"></td>
	        		<td align="right" width="35%">PHP {{number_format(($totalProfit*-1),2)}}</td>
				@endif
  			</tr>
		      
		    <tr>
		        <td colspan="2"> <strong>Balance at the end of the Period: </strong></td>
		        <td align="right" width="35%">PHP {{ number_format($eqTotalSum,2) }}</td>
		    </tr>
  		</table>
  	</body>
</html>