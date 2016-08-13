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
		                            <th>Grand Total</th>
                        		</tr>
                    		</thead>
                 
                    		<tfoot>
                        		<tr>
		                            <th>Receipt No.</th>
		                            <th>Invoice No.</th>
		                            <th>Date Paid</th>
		                            <th>Charged to</th>
		                            <th>Grand Total</th>
                        		</tr>
                    		</tfoot>
                 
                    		<tbody>
                        		<tr>
		                            <td><a href="./details.html">00001</a></td>
		                            <td><a href="../invoice/details.html">00001</a></td>
		                            <td>08/03/2016 </td>
		                            <td>Tiger Nixon</td>
		                            <td>₱ 3,600</td>
                        		</tr>
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