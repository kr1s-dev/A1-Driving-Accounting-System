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
          		<h2>Invoice</h2>
      		</div>
  		</div>
  		<hr/>
  
  		<div style="display:inline-block; width:100%">
      	<div style="float:left;">
          	<strong>Invoice #: {{sprintf("%'.07d\n",$invoice->id)}}</strong>
      	</div>
      		<div style="float:right;">
          		Payment Due Date: {{date('F d, Y',strtotime($invoice->payment_due_date))}}
      		</div>
  		</div>
  		<br/><br/>
  		<div>
      		<table>
          		<tr>
              		<td><strong> Student Information </strong></td>
          		</tr>
          		<tr>
              		<td> Name:  {{$invoice->studentInfo->stud_first_name}} {{$invoice->studentInfo->stud_last_name}}</td>
          		</tr>
          		<tr>
              		<td> Address:  {{$invoice->studentInfo->stud_address}} </td>
          		</tr>
          		<tr>
              		<td> Contact Number:  {{$invoice->studentInfo->stud_mobile_no}}</td>
          		</tr>
          		<tr>
              		<td> Email Address:  {{$invoice->studentInfo->stud_email}}</td>
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
              
          		@foreach($invoice->invoiceItemsInfo as $invItem)
          			<tr>
	              		<td style="padding:0px 10px 0px 10px;"> {{$invItem->item->item_name}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> {{$invItem->remarks}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> PHP {{$invItem->amount}}  </td>
	          		</tr>
          		@endforeach
              <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> Sub Total: </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{number_format($invoice->total_amount-(number_format($invoice->total_amount*.12,2)),2)}}</td>
              </tr>
              <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> VAT(12%): </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{number_format($invoice->total_amount*.12,2)}}</td>
              </tr>
          		<tr>
              		<td colspan="2" align="right" style="padding-right:5px;"> Total Amount: </td>
              		<td style="padding:0px 10px 0px 10px;">PHP {{$invoice->total_amount}}</td>
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