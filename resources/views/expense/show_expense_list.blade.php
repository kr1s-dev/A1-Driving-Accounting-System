@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
	  	<div class="section">
	     	<!--DataTables example-->
	     	<div id="table-datatables">
	        	<h4 class="header">View All Expenses</h4>
	        	<div class="row">
	           		<div class="col s12 m12 l12">
	              		<table id="data-table-simple" class="responsive-table display" cellspacing="0">
	                 		<thead>
			                    <tr>
			                       <th>Expense No.</th>
			                       <th>Vendor Name</th>
			                       <th>Address</th>
			                       <th>Number</th>
			                       <th>Total Amount</th>
			                       <th>Action</th>
			                    </tr>
	                 		</thead>
			                 <tfoot>
			                    <tr>
			                       <th>Expense No.</th>
			                       <th>Vendor Name</th>
			                       <th>Address</th>
			                       <th>Number</th>
			                       <th>Total Amount</th>
			                       <th>Action</th>
			                    </tr>
	                 		</tfoot>
	                 		<tbody>
	                 			@foreach($expenseList as $expense)
				                    <tr>
				                       <td><a href="{{route('expense.show',$expense->id)}}">#{{sprintf("%'.07d\n",$expense->id)}}</a></td>
				                       <td>{{$expense->vendor_name}}</td>
				                       <td>{{$expense->vendor_address}}</td>
				                       <td>{{$expense->vendor_number}}</td>
				                       <td>₱ {{number_format($expense->total_amount,2,'.',',')}}</td>
				                       <td class="center-align">
	                                        <a href="{{route('expense.edit',$expense->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
	                                        <i class="mdi-content-create"></i>
	                                        </a>
	                                    </td>
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
@endsection