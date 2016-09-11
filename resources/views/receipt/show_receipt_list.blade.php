@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
    <div class="container">
        <div class="section">
			<!--DataTables example-->
            <div id="table-datatables">
              	<h4 class="header">View All Receipts</h4>
              	<div class="row">
                	<div class="col s12 m12 l12">
                  		<table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    		<thead>
                        		<tr>
		                            <th>Receipt No.</th>
		                            <th>Invoice No.</th>
		                            <th>Date Paid</th>
		                            <th>Charged to</th>
		                            <th>Amount Paid</th>
                        		</tr>
                    		</thead>
                 
                    		<tfoot>
                        		<tr>
		                            <th>Receipt No.</th>
		                            <th>Invoice No.</th>
		                            <th>Date Paid</th>
		                            <th>Charged to</th>
		                            <th>Amount Paid</th>
                        		</tr>
                    		</tfoot>
                 
                    		<tbody>
                                @foreach($receiptList as $receipt)
                                <tr>
                                    <td><a href="{{route('receipt.show',$receipt->id)}}">{{sprintf("%'.07d\n",$receipt->id)}}</a></td>
                                    <td><a href="{{route('invoice.show',$receipt->invoiceInfo->id)}}">{{sprintf("%'.07d\n",$receipt->invoiceInfo->id)}}</a></td>
                                    <td>{{date('m-d-Y',strtotime($receipt->created_at))}}</td>
                                    <td>{{$receipt->invoiceInfo->studentInfo->stud_first_name}}&nbsp;{{$receipt->invoiceInfo->studentInfo->stud_last_name}}</td>
                                    <td>₱ {{number_format($receipt->amount_paid,2,'.',',')}}</td>
                                </tr>
                                @endforeach
                    		</tbody>
                  		</table>
                	</div>
              	</div>
            </div> 
            <br>
        </div>
    </div>
    <!--end container-->
@endsection