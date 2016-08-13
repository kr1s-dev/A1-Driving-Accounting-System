@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
        <div class="section">
           	<!--DataTables example-->
            <div id="table-datatables">
              	<h4 class="header">View All Invoices</h4>
              	<div class="row">
                	<div class="col s12 m12 l12">
                  		<table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    		<thead>
                        		<tr>
		                            <th>Invoice No.</th>
		                            <th>Date Paid</th>
		                            <th>Charged to</th>
		                            <th>Grand Total</th>
		                            <th>Actions</th>
                        		</tr>
                    		</thead>
                 
                    		<tfoot>
                        		<tr>
		                            <th>Invoice No.</th>
		                            <th>Date Paid</th>
		                            <th>Charged to</th>
		                            <th>Grand Total</th>
		                            <th>Actions</th>
                        		</tr>
                    		</tfoot>
                 
                    		<tbody>
                    			@foreach($invoiceList as $invoice)
                    				<tr>
	                            		<td><a href="{{route('invoice.show',$invoice->id)}}">{{sprintf("%'.07d\n", $invoice->id)}}</a></td>
	                            		<td>
	                            			@if($invoice->is_paid)
	                            				{{date('m-d-Y',strtotime($invoice->updated_at))}}
	                            			@else
	                            				Not Yet Paid
	                            			@endif

	                            		</td>
	                            		<td>{{$invoice->studentInfo->stud_first_name}}&nbsp;{{$invoice->studentInfo->stud_last_name}}</td>
	                            		<td>₱ {{number_format($invoice->total_amount,2)}}</td>
                                  @if($invoice->is_paid)
                                    <td class="center-align">
                                      <a href="#" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                                      <i class="mdi-content-create"></i>
                                      </a>
                                      <a href="#" class="btn-floating waves-effect waves-light grey darken-4">
                                        <i class="mdi-action-lock"></i>
                                      </a>
                                    </td>
                                  @else
                                    <td class="center-align">
                                        <a href="{{route('invoice.edit',$invoice->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                                        <i class="mdi-content-create"></i>
                                        </a>
                                        <a href="{{route('invoice.receipt.create',$invoice->id)}}" class="btn-floating waves-effect waves-light grey darken-4">
                                          <i class="mdi-action-lock"></i>
                                        </a>
                                    </td>
                                  @endif
	                            		
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
    <!-- Floating Action Button -->
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
        <a href="./add.html" class="btn-floating btn-large red darken-2">
          <i class="mdi-content-add-circle"></i>
        </a>
    </div>
    <!-- Floating Action Button -->
@endsection