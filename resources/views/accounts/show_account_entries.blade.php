@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
   	<div class="container account-information">
      	<div class="section">
          	<div id="table-datatables">
            	<h4 class="header">View All Account Entries</h4>
            	<div class="row right-align">
                	<div class="col l12 m12 s12">
                  		<a href="../invoices/create.html" class="btn waves-effect waves-light cyan" type="submit" name="action">
                     		Create New Journal Entry
                  		</a>
                	</div>
            	</div>
            	<div class="row">
               	<div class="col s12 m12 l12">
                  	<table id="data-table-simple" class="responsive-table display" cellspacing="0">
                     	<thead>
	                        <tr>
	                           <th>Date</th>
	                           <th>Ref #</th>
	                           <th>Description</th>
	                           <th>Debit</th>
	                           <th>Credit</th>
	                           <th>Debit Amount</th>
	                           <th>Credit Amount</th>
	                        </tr>
                     	</thead>
                     	<tfoot>
	                        <tr>
	                           <th>Date</th>
	                           <th>Ref #</th>
	                           <th>Description</th>
	                           <th>Debit</th>
	                           <th>Credit</th>
	                           <th>Debit Amount</th>
	                           <th>Credit Amount</th>
	                        </tr>
                     	</tfoot>
                     	<tbody>
	                        <tr>
	                           <td>08/07/2016</td>
	                           <td>#0000001</td>
	                           <td>Bought Item: Table</td>
	                           <td>Furnitures</td>
	                           <td></td>
	                           <td>5000.00</td>
	                           <td></td>
	                        </tr>
                     	</tbody>
                  	</table>
               	</div>
            </div>
        </div>
    </div>
<!--end container-->
@endsection