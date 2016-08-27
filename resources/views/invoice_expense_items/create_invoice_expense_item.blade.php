@extends('master_layout.master_page_layout')
@section('content')
<!--start container-->
	<div class="container">
   		<div class="section">
      		<div id="table-datatables">
	         	<h4 class="header">Create a New Item</h4>
	         	<div class="row">
            		<div class="col s12 m12 l12">
               			<div class="card-panel">
                  			<h4 class="header2">Item Information</h4>
                 			<div class="row">
                     			{!! Form::open(['url'=>'item','method'=>'POST','class'=>'col s12']) !!}
			                        @include('invoice_expense_items.invoice_expense_item_form',['submitButton'=>'Submit'])
			                    {!! Form::close() !!}
                  			</div>
               			</div>
            		</div>
         		</div>
      		</div>
   		</div>
	</div>
<!--end container-->
@endsection
