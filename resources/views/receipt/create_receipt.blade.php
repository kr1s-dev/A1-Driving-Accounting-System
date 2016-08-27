@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
        <div id="invoice">
            <div class="invoice-header">
              	<div class="row section">
                	<div class="col s12 m6 l6">
                  		<img src="{{ URL::asset('images/generic-logo.png')}}" alt="company logo">
              			<p>To,
                			<br/>
                			<span class="strong">{{$invoice->studentInfo->stud_first_name}}&nbsp;{{$invoice->studentInfo->stud_last_name}}</span>
                			<br/>
                			<span>{{$invoice->studentInfo->stud_address}}</span>
                			<br/>
                			<span>{{$invoice->studentInfo->stud_mobile_no}}</span>
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
                      				<h4 class="header">₱ {{$invoice->total_amount}}</h4>
                    		</div>
                    		<div class="col s12 m3 l3">
                      			<p class="strong">Receipt No</p>
                      			<h4 class="header">#{{sprintf("%'.07d\n", $recNumber)}}</h4>
                    		</div>
                    		<div class="col s12 m3 l3">
                      			<p class="strong">Invoice No</p>
                      			<h4 class="header">#{{sprintf("%'.07d\n", $invoice->id)}}</h4>
                    		</div>
                    		<div class="col s12 m3 l3">
                      			<p class="strong">Due Date</p>
                      			<h4 class="header">{{date('m/d/y',strtotime($invoice->payment_due_date))}}</h4>
                    		</div>
                  		</div>
                	</div>
              	</div>
            </div>
            <br>
            <!-- Modal Structure 
            <div id="modal1" class="modal modal-fixed-footer">
                <div class="modal-content">
                  	<h4>Add a New Item</h4>
              		<div class="divider"></div>
              			<div class="row">
                			<div class="input-field">
                  				<select name="desc" id="desc">
                    				<option value="1">Course Fee</option>
			                        <option value="1">Student Permit</option>
			                        <option value="2">Driver's Manual</option>
			                        <option value="3">Downpayment</option>
			                        <option value="4">Non-Pro/Pro</option>
			                        <option value="5">Int't License</option>
			                        <option value="6">Certificate</option>
                  				</select>
                  				<label for="email">Description</label>
                			</div>
              			</div>
              			<div class="row">
                		<div class="input-field">
                      		<input id="amount" type="number">
                      		<label for="email">Amount (₱)</label>
                		</div>
              		</div>
            	</div>
                <div class="modal-footer">
                  <a href="#!" id="add-item" class="modal-action modal-close waves-effect waves-green btn-flat add-item">Add</a>
                </div>
            </div>
            -->
            <div class="">
              	<div class="row">
                	<div class="col s12 m12 l12">
                  		<table class="striped">
                    		<thead>
                      			<tr>
			                        <th data-field="item">Description</th>
			                        <th data-field="uprice">Amount</th>
                      			</tr>
                    		</thead>
                    		<tbody class="items">
                    			@foreach($invoice->invoiceItemsInfo as $invoiceItem)
                    				<tr>
				                        <td>{{$invoiceItem->item->item_name}}</td>
				                        <td>₱ {{$invoiceItem->amount}}</td>
				                    </tr>
                    			@endforeach
                      			<tr>
                        			<td>Sub Total:</td>
                        			<td>₱ {{number_format($invoice->total_amount - $invoice->total_amount*.12,2)}}</td>
                       			</tr>
                      			<tr>
                        			<td>VAT (12%)</td>
                        			<td>₱ {{number_format($invoice->total_amount *.12,2)}}</td>
                      			</tr>
                      			<tr>
			                        <td class="cyan white-text">Grand Total</td>
			                        <td class="cyan strong white-text">₱ {{number_format($invoice->total_amount,2)}}</td>
                      			</tr>
                      			<tr>
			                        <td class="cyan white-text">Outstanding Balance</td>
			                        <td class="cyan strong white-text">₱ 
			                        	@if($lastInvReceipt === NULL)
			                        		{{number_format($invoice->total_amount,2)}}
			                        	@else
			                        		{{number_format($lastInvReceipt->outstanding_balance,2)}}
			                        	@endif
			                        </td>
                      			</tr>
                      			{!! Form::open(['url'=>'receipt','method'=>'POST','class'=>'col s12']) !!}
                      				<input type="hidden" name="payment_id" value="{{$invoice->id}}">
                      				<input type="hidden" name="outstanding_balance" value="{{$lastInvReceipt === NULL?number_format($invoice->total_amount,2):number_format($lastInvReceipt->outstanding_balance,2)}}">
	                      			<tr>
				                        <td >Amount Paid (₱) </td>
				                        <td >
				                        	<div class="input-field col s12 m12 l6">
				                        		<input type="number" min="1" step="0.01" name="amount_paid" id="paidAmount" required>
				                        	</div>
				                        </td>
	                      			</tr>
	                      			<!-- Floating Action Button -->
          								    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
          								    	<button class="btn-floating btn-large red darken-2" type="submit" name="action">
              										<i class="mdi-content-send right"></i>
              									</button>
          								    </div>
								              <!-- Floating Action Button -->
                      			{!! Form::close() !!}
                      			<tr>
			                        <td class="red darken-2 white-text">Tendered By</td>
			                        <td class="red darken-2 white-text">{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}</td>
                      			</tr>
                    		</tbody>
                  		</table>
                	</div>
              	</div>
            </div>
            
            <div class="invoice-footer">
              	<div class="row">
                	<div class="col s12 m6 l6">
                  		<p class="strong">Payment Method</p>
              			<p>Please make the cheque to: <strong>Tiger Nixon</strong></p>
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
            </div>
        </div>
    </div>
              
   
@endsection