<!DOCTYPE html>
<html lang="en">
  	<head>
      <style>
            body {
              font-family: "Open Sans", "Arial", "Calibri", sans-serif;
              font-size: 12px;
            }
            .header p, .header h4{
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
       	<div style="display:inline-block; width:100%">
          <div class="header">
              <p><strong>A1 Driving School</strong></p>
             <p>A-1 Driving Bldg, #2 Sta. Lucia St., 1550</p>
             <p>+63 (2) 532.2272 / +63 (927) 7415331 / +63 (942) 3827688</p>
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
      		<table cellspacing="0" width="100%">
          		<tr>
              		<th colspan="3" class="header"><h4><strong> Receiver Information </strong></h4></th>
          		</tr>
          		<tr>
                  <td>{{$expense->vendor_number}}</td>
                  <td>{{$expense->vendor_address}}</td>
                  <td>{{$expense->vendor_name}}</td>
                
          		</tr>
      		</table>
  		</div>
  		<br/>
  		<div>
      		<table border="1" style="width:100%; border-collapse: collapse; border: 1px solid black;">
          		<tr>
              		<th> Item </th>
              		<th> Description</th>
              		<th> Amount </th>
          		</tr>
          		@foreach($expense->expenseItemsInfo as $expItem)
          			<tr>
	              		<td> {{$expItem->item->item_name}}  </td>
	              		<td> {{$expItem->remarks}}  </td>
	              		<td> PHP {{$expItem->amount}}  </td>
	          		</tr>
          		
          		@endforeach
          		<tr>
              		<td colspan="2" align="right" style="padding-right:5px;"> Total Amount: </td>
              		<td>PHP {{$expense->total_amount}}</td>
          		</tr>
      		</table>
  		</div>
  		<br/><br/>
  		<div style="margin-left: 70%;">
  			_______________________________ <br/>
  			<div align="center" style="width:100%">
  				{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}
  			</div>
  		</div>
  	</body>
</html>