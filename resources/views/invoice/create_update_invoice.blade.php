@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
	<div class="container">
		<meta name="_method" content="{{ $_method }}">
		<meta name="_token" content="{{ csrf_token() }}">
		<meta name="student_id" content="{{ $student->id }}">
		<meta name="invoice_id" content="{{ $invoice->id }}">
	  	<div id="invoice">
	    	<div class="invoice-header">
	      		<div class="row section">
	        		<div class="col s12 m6 l6">
	          			<img src="{{ URL::asset('images/generic-logo.png')}} " alt="company logo">
	         			<p>To,
		            		<br/>

		            		<span class="strong">{{$student->stud_first_name}}&nbsp;{{$student->stud_last_name}}</span>
		            		<br/>
		            		<span>{{$student->stud_address}}</span>
		            		<br/>
		            		<span>{{$student->stud_mobile_no}}</span>
	          			</p>
	       	 		</div>

		        	<div class="col s12 m6 l6">
		          		<div class="invoce-company-address right-align">
		            		<span class="invoice-icon"><i class="mdi-social-location-city cyan-text"></i></span>

		            		<p><span class="strong">A1 Driving School</span>
		              			<br/>
				              	<span>125, ABC Street,</span>
				              	<br/>
				              	<span>New Yourk, USA</span>
				              	<br/>
				              	<span>+91-(444)-(333)-(221)</span>
		            		</p>
		          		</div>

			          	<div class="invoce-company-contact right-align">
			            	<span class="invoice-icon"><i class="mdi-communication-quick-contacts-mail cyan-text"></i></span>
			            	<p><span class="strong">www.exampledomain.com</span>
			              		<br/>
			              		<span>info@exampledomain.com</span>
			              		<br/>
			              		<span>admin@exampledomain.com</span>
			            	</p>
			          	</div>
	        		</div>
	      		</div>
	    	</div>

	    	<div class="invoice-lable">
	      		<div class="row">
	        		<div class="col s12 m3 l3 cyan">
	          			<h4 class="white-text invoice-text">COURSE FEE</h4>
	        		</div>
	        		<div class="col s12 m9 l9 invoice-brief cyan white-text">
	          			<div class="row">
	            			<div class="col s12 m3 l3">
	              				<p class="strong">Total Due</p>
	              				<h4 class="header" id="totDue">₱ {{$invoice->total_amount!=NULL?$invoice->total_amount:0}}</h4>
	            			</div>
	            			<div class="col s12 m3 l3">
		              			<p class="strong">Invoice No</p>
		              			<h4 class="header">#{{sprintf("%'.07d\n", $invNumber)}}</h4>
	            			</div>
	            			<br>
	            			<div class="col s12 m3 l3">
	              				<div class="input-field col s12 m6 l12 due-date">
	                				<input type="date" class="datepicker" id="paymentDueDate"  value="{{$invoice->payment_due_date!=NULL?date('d F, Y',strtotime($invoice->payment_due_date)):''}}">
	                				<label for="birthday" class="white-text">Due Date</label>
	              				</div>
	            			</div>
	          			</div>
	        		</div>
	      		</div>
	    	</div>
	    	<br>
	    	<div class="row right-align">
	        	<div class="col l12 m12 s12">
	          		<a href="#modal1" class="modal-trigger btn waves-effect waves-light cyan" type="submit" name="action">Add a New Item
	          			<i class="mdi-action-note-add">
	          			</i>
	        		</a>
	        	</div>
	    	</div>
	    	<!-- Modal Structure 1-->
	      	<div id="modal1" class="modal modal-fixed-footer">
	        	<div class="modal-content">
	          		<h4>Add a New Item</h4>
	          			<div class="divider"></div>
          				<div class="row">
            				<div class="input-field">
              					<select name="desc" id="desc">
              						<option value="" disabled selected>Select Particular</option>
					                @foreach($incomeAccountItems as $items)
              							<option value="{{$items->id}}">{{$items->item_name}}</option>
              						@endforeach
              					</select>
              					<label for="email">Description</label>
            				</div>
          				</div>
	          			<div class="row">
	            			<div class="input-field">
	              				<input id="amount" min="0" type="number" step="0.01">
	              				<label for="email">Amount (₱)</label>
	            			</div>
	          			</div>
	        		</div>
	        		<div class="modal-footer">
	          			<a href="#!" id="add-item" class="modal-action modal-close waves-effect waves-green btn-flat add-item">Add</a>
	        		</div>
	        	</div>
	      	</div>
	      	<!-- End Modal Structure 1 -->

	      	<!-- Modal Structure 2-->
	     	<div id="modal2" class="modal modal-fixed-footer">
	     		<div class="modal-content">
	          		<h4>Update Item</h4>
	          			<div class="divider"></div>
	          			<div class="row">
	            			<div class="input-field">
	              				<input id="eAmount" min="0" type="number" step="0.01">
	              				<label id="eAmountLabel" for="email">Amount (₱)</label>
	            			</div>
	          			</div>
	        		</div>
	        		<div class="modal-footer">
	          			<a href="#!" id="edit-item" class="modal-action modal-close waves-effect waves-green btn-flat">Edit</a>
	        		</div>
	        	</div>
	      	</div>
	      	<!-- End Modal Structure 2 -->

	      	
	    <div class="">
	      	<div class="row">
	        	<div class="col s12 m12 l12">
	          		<table class="striped" id="itemsTable">
	            		<thead>
	              			<tr>
				                <th data-field="item">Description</th>
				                <th data-field="uprice">Amount</th>
				                <th data-field="actions">Actions</th>
	              			</tr>
	            		</thead>
	            		<tbody class="items">
	            			@foreach($invoice->invoiceItemsInfo as $invoiceItem)
	            				<tr>
	            					<td width="42%">{{$invoiceItem->item->item_name}}</td>
	            					<td>₱ {{$invoiceItem->amount}}</td>
	            					<td class>
		                  				<a href="#modal2" style="margin-right: 5%;" class="modal-trigger btn-floating waves-effect waves-light grey darken-4 edit-item">
		                    				<i class="mdi-content-create"></i>
		                  				</a>
		                  				<a style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4 delete-item">
		                    				<i class="mdi-action-delete"></i>
		                  				</a>
		                			</td>
	            				</tr>
	            			@endforeach
	              			<!--tr>
	                			<td>MacBook Pro</td>
	                			<td>₱ 1,299.00</td>
	                			<td class="center-align">
	                  				<a href="#modal2" style="margin-right: 5%;" class="modal-trigger btn-floating waves-effect waves-light grey darken-4">
	                    				<i class="mdi-content-create"></i>
	                  				</a>
	                  				<a style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4 delete-item">
	                    				<i class="mdi-action-delete"></i>
	                  				</a>
	                			</td>
	              			</tr-->
	            		</tbody>
	          		</table>
	         		<table class="striped" id="amountCalc">
	            		<tbody>
	              			<tr>
	                			<td width="42%">Sub Total:</td>
	                			<td >₱ 0</td>
	               			</tr>
	              			<tr>
		                		<td width="42%">VAT(12%)</td>
		                		<td >₱ 0</td>
	              			</tr>
	              			<tr>
	                			<td width="42%" class="cyan white-text">Grand Total</td>
	                			<td class="cyan strong white-text">₱ 0</td>
	              			</tr>
	            		</tbody>
	          		</table>
	        	</div>
	      	</div>
	      	
	    </div>
	    
	    <!--div class="invoice-footer">
	      	<div class="row">
	        	<div class="col s12 m6 l6">
	          		<p class="strong">Payment Method</p>
	          		<p>Please make the cheque to: <div class="input-field"><input id="cheque" type="text"><label for="checque">Recipient</label></div></p>
	          		<p class="strong">Terms & Condition</p>
		          	<ul>
		            	<li>You know, being a test pilot isn't always the healthiest business in the world.</li>
		            	<li>We predict too much for the next year and yet far too little for the next 10.</li>
		          	</ul>
	        	</div>
	        	<div class="col s12 m6 l6 center-align">
	          		<p>Approved By</p>
          			<img src="{{ URL::asset('images/signature-scan.png')}}" alt="signature">
          			<p class="header">AMANDA ORTON</p>
         			<p>Managing Director</p>
	        	</div>
	      	</div>
	    </div-->
	      
	  <!-- Floating Action Button -->
	  	<div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
	        <a class="btn-floating btn-large red darken-2" id="invBtn">
	          <i class="mdi-content-send"></i>
	        </a>
	    </div>
	    <!-- Floating Action Button -->
	</div>

	<!--end container-->
@endsection