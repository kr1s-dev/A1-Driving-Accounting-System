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
          		<h2>Invoice</h2>
      		</div>
  		</div>
  		<hr/>
  
  		<div style="width:100%">
      	<div style="float:left;">
          	<strong>Invoice #: {{sprintf("%'.07d\n",$invoice->id)}}</strong>
      	</div>
      		<div style="float:right;">
          		Payment Due Date: {{date('F d, Y',strtotime($invoice->payment_due_date))}}
      		</div>
  		</div>
  		<br/><br/>
  		<div>
      		<table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
          		<tr class="header">
              		<th colspan="2"><strong> <h4> Student Information </h4></strong></th>
          		</tr>
          		<tr>
              		<td> <strong>Name:</strong>  {{$invoice->studentInfo->stud_first_name}} {{$invoice->studentInfo->stud_last_name}}</td>
                  <td> <strong>Address:</strong> {{$invoice->studentInfo->stud_address}} </td>
          		</tr>
          		<tr>
                <td> <strong>Contact Number:</strong>  {{$invoice->studentInfo->stud_mobile_no}}</td>
                <td> <strong>Email Address:</strong>  {{$invoice->studentInfo->stud_email}}</td>
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
              
          		@foreach($invoice->invoiceItemsInfo as $invItem)
          			<tr>
	              		<td> {{$invItem->item->item_name}}  </td>
	              		<td> {{$invItem->remarks}}  </td>
	              		<td> PHP {{number_format($invItem->amount,2,'.',',')}}  </td>
	          		</tr>
          		@endforeach
              <tr>
                  <td style="background:#eee" colspan="2" align="right" style="padding-right:5px;"> Sub Total: </td>
                  <td>PHP {{number_format($invoice->total_amount-(number_format($invoice->total_amount/1.12,2)),2,'.',',')}}</td>
              </tr>
              <tr>
                  <td style="background:#eee" colspan="2" align="right" style="padding-right:5px;"> VAT(12%): </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{number_format($invoice->total_amount/1.12,2,'.',',')}}</td>
              </tr>
          		<tr>
              		<td style="background:#eee" colspan="2" align="right" style="padding-right:5px;"> Total Amount: </td>
              		<td>PHP {{number_format($invoice->total_amount,2,'.',',')}}</td>
          		</tr>
      		</table>
  		</div>
  		<br/><br/>
  		<div style="margin-left: 70%;">
  			_______________________________ <br/>
  			<div align="center">
          {{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}
  			</div>
  		</div>
  	</body>
</html>