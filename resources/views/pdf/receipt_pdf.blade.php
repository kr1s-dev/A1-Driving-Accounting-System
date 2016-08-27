<!DOCTYPE html>
<html lang="en">
  	<head>
  	</head>
  	<style>
  		

  	</style>
  	<body>
       	<div style="display:inline-block; width:100%">
      		<div>
          		<h2><strong>A1 Driving School</strong></h2>
      		</div>
      		<div style="float:right;">
          		<h2>Cash Receipt</h2>
      		</div>
  		</div>
  		<hr/>
  
  		<div style="display:inline-block; width:100%">
      	<div style="float:left;">
          	<strong>Receipt #: {{sprintf("%'.07d\n",$receipt->id)}}</strong>
      	</div>
      		<div style="float:right;">
          		Date Paid: {{date('F d, Y',strtotime($receipt->created_at))}}
      		</div>
  		</div>
  		<div>
      		<strong>invoiceInfo Referrence #: {{sprintf("%'.07d\n",$receipt->invoiceInfo->id)}}</strong>
  		</div>
  		<br/>
  		<div>
      		<table>
          		<tr>
              		<td><strong> Payee Information </strong></td>
          		</tr>
          		<tr>
              		<td> Name:  {{$receipt->invoiceInfo->studentInfo->stud_first_name}} {{$receipt->invoiceInfo->studentInfo->stud_last_name}}</td>
          		</tr>
          		<tr>
              		<td> Address:  {{$receipt->invoiceInfo->studentInfo->stud_address}} </td>
          		</tr>
          		<tr>
              		<td> Contact Number:  {{$receipt->invoiceInfo->studentInfo->stud_mobile_no}}</td>
          		</tr>
          		<tr>
              		<td> Email Address:  {{$receipt->invoiceInfo->studentInfo->stud_email}}</td>
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
          		@foreach($receipt->invoiceInfo->invoiceItemsInfo as $invItem)
          			<tr>
	              		<td style="padding:0px 10px 0px 10px;"> {{$invItem->item->item_name}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> {{$invItem->remarks}}  </td>
	              		<td style="padding:0px 10px 0px 10px;"> PHP {{$invItem->amount}}  </td>
	          		</tr>
          		
          		@endforeach
              <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> Sub Total: </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{number_format($receipt->invoiceInfo->total_amount-(number_format($receipt->invoiceInfo->total_amount*.12,2)),2)}}</td>
              </tr>
              <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> VAT(12%): </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{number_format($receipt->invoiceInfo->total_amount*.12,2)}}</td>
              </tr> 
          		<tr>
              		<td colspan="2" align="right" style="padding-right:5px;"> Total Amount: </td>
              		<td style="padding:0px 10px 0px 10px;">PHP {{$receipt->invoiceInfo->total_amount}}</td>
          		</tr>
              <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> Amount Paid: </td>
                  <td style="padding:0px 10px 0px 10px;">PHP {{$receipt->amount_paid}}</td>
              </tr>
              @if($receipt->outstanding_balance != 0)
                <tr>
                    <td colspan="2" align="right" style="padding-right:5px;"> Outstanding Balance: </td>
                    <td style="padding:0px 10px 0px 10px;">PHP {{$receipt->outstanding_balance}}</td>
                </tr>
              @elseif($receipt->change != 0)
                <tr>
                  <td colspan="2" align="right" style="padding-right:5px;"> Change: </td>
                    <td style="padding:0px 10px 0px 10px;">PHP {{$receipt->change}}</td>
                </tr>
              @endif
              
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