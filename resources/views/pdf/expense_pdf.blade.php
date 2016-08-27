<!DOCTYPE html>
<html lang="en">
  	<head>
  	</head>
  	<body>
       	<div style="display:inline-block; width:100%">
      		<div>
          		<h2><strong>A1 Driving School</strong></h2>
      		</div>
      		<div style="float:right;">
          		<h2>Cash Voucher</h2>
      		</div>
  		</div>
  		<hr/>
  
  		<div style="display:inline-block; width:100%">
      	<div style="float:left;">
          	<strong>Cash Voucher #: {{sprintf("%'.07d\n",$expense->id)}}</strong>
      	</div>
      		<div style="float:right;">
          		Date filed: {{date('F d, Y',strtotime($expense->created_at))}}
      		</div>
  		</div>
  		<br/><br/>
  		<div>
      		<table>
          		<tr>
              		<td><strong> Receiver Information </strong></td>
          		</tr>
          		<tr>
                  <p>{{$expense->vendor_number}}</p>
                  <p>{{$expense->vendor_address}}</p>
                  <p>{{$expense->vendor_name}}</p>
                
          		</tr>
      		</table>
  		</div>
  		<br/>
  		<div>
      		<table border="1" style="width:100%; border-collapse: collapse; border: 1px solid black;">
          		<tr>
              		<th style="padding:0px 10px 0px 10px;"> Item </th>
              		<th style="padding:0px 10px 0px 10px;"> Description</th>
              		<th style="padding:0px 10px 0px 10px;"> Amount </th>
          		</tr>
          		@foreach($expense->expenseItemsInfo as $expItem)
          			<tr>
	              		<td style="padding:0px 10px 0px 10px;"> {{$expItem->item->item_name}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> {{$expItem->remarks}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> PHP {{$expItem->amount}}  </td>
	          		</tr>
          		
          		@endforeach
          		<tr>
              		<td colspan="2" align="right" style="padding-right:5px;"> Total Amount: </td>
              		<td style="padding:0px 10px 0px 10px;">PHP {{$expense->total_amount}}</td>
          		</tr>
      		</table>
  		</div>
  		<br/><br/>
  		<div style="margin-left: 60%;">
  			_______________________________ <br/>
  			<div align="center" style="width:90%">
  				{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}
  			</div>
  		</div>
  	</body>
</html>