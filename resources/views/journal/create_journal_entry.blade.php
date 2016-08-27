@extends('master_layout.master_page_layout')
@section('content')
 	<!--start container-->
   	<div class="container account-entries">
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <meta name="account-list" content="{{ $accountTitlesList }}">
         <meta name="type" content="{{ $type }}">
      	<div class="section">
          	<div id="table-datatables">
            	<h4 class="header">Create a New Journal Entry</h4>
            	<div class="row">
               		<div class="col s12 m12 l12">
                  		<table class="responsive-table display journal-entries" cellspacing="0">
                     		<thead>
                        		<tr>
                           			<th>Dr/Cr</th>
                           			<th>Account Title</th>
                           			<th>Description</th>
                           			<th>Debit Amount</th>
                           			<th>Credit Amount</th>
                           			<th>Actions</th>
                        		</tr>
                     		</thead>
                     		<tbody>
                        	<tr>
	                           <td>
	                              <select name="drcr" id="">
	                                 <option value="1">Debit</option>
	                                 <option value="2">Credit</option>
	                              </select>
	                           </td> 
	                           <td>
	                              <select name="account_title" id="">
                                    @foreach($accountTitlesList as $accountTitle)
	                                   <option value="{{$accountTitle->id}}">{{$accountTitle->account_title_name}}</option>
                                    @endforeach
	                              </select>
	                           </td>
	                           <td style="width: 20%;">
	                              	<div class="input-field" id="textarea-input-field">
		                                 <textarea class="materialize-textarea" name="" id="desc" cols="30" rows="2"></textarea>
		                                 <label for="desc">Description</label>
	                              	</div>
	                           </td>
                           		<td>
                              		<div class="input-field">
                                 		<input type="number" min="0" step="0.01" id="dr-amt" value="0.00">
                                 		<label for="dr-amt" class="active">Amount</label>
                              		</div>
                           		</td>
	                          	<td>
	                              	<div class="input-field">
	                                 	<input type="number" id="cr-amt" value="0.00" disabled="disabled">
	                                 	<label for="cr-amt" class="active">Amount</label>
	                              	</div>
	                           	</td>
                           		<td>
                              		<a class="waves-effect waves-light btn red add-entry">Add</a>
                           		</td>
                        	</tr>
                     	</tbody>
                  	</table>
               	</div>
            </div>
         </div>
        <div class="row">
            <div class="col l12 right-align">
               <a class="waves-effect waves-light blue btn" id="sbmt_jour_entry"><i class="mdi-content-send right"></i>Submit</a>
            </div>
        </div>
    </div>
@endsection