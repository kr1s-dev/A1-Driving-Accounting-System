@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
	<div class="container">
   		<div class="section">
      		<div id="table-datatables">
	         	<h4 class="header">Update Account Title</h4>
	         	<div class="row">
            		<div class="col s12 m12 l12">
               			<div class="card-panel">
                  			<h4 class="header2">Account Title Information</h4>
                 			<div class="row">
                              {!! Form::model($accounttitle, ['method'=>'PATCH','action' => ['AccountTitles\AccountTitleController@update',$branch->id] , 'class' => 'col s12']) !!}
                                 @include('branches.branches_form',['submitButton'=>'Update Account Title']);
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