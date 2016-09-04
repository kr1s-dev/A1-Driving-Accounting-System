@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
      	<div class="section">
         	<!--DataTables example-->
         	<div id="table-datatables">
            	<h4 class="header">View All Branches</h4>
            	<div class="row">
               		<div class="col s12 m12 l12">
                  		<table id="data-table-simple" class="responsive-table display" cellspacing="0">
                     		<thead>
		                        <tr>
		                           <th>Branch No.</th>
		                           <th>Branch Name</th>
		                           <th>Address</th>
		                           <th>Office Number</th>
		                           <th>Main Office?</th>
		                           <th>Actions</th>
		                        </tr>
                     		</thead>
	                     	<tfoot>
		                        <tr>
		                           <th>Branch No.</th>
		                           <th>Branch Name</th>
		                           <th>Address</th>
		                           <th>Office Number</th>
		                           <th>Main Office?</th>
		                           <th>Actions</th>
	                        	</tr>
	                     	</tfoot>
	                     	<tbody>
	                     		@if($branchList != NULL)
		                     		@foreach($branchList as $branch)
		                     			<tr>
				                           <td><a href="{{route('branches.show',$branch->id)}}"><em><strong>{{sprintf("%'.07d\n",$branch->id)}}</strong></em></a></td>
				                           <td>{{$branch->branch_name}}</td>
				                           <td>{{$branch->branch_address}}</td>
				                           <td>{{$branch->branch_tel_number}}</td>
				                           <td>
				                           		@if($branch->main_office)
				                           			Yes
				                           		@else
				                           			No
				                           		@endif
				                           </td>
				                           <td class="center-align">
				                              <a href="{{route('branches.edit',$branch->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
				                              <i class="mdi-content-create"></i>
				                              </a>
				                              <a class="btn-floating waves-effect waves-light grey darken-4">
				                              <i class="mdi-action-lock"></i>
				                              </a>
				                           </td>
			                        	</tr>
		                     		@endforeach
	                     		@endif
	                     		
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
    <a href="{{route('branches.create')}}" class="btn-floating btn-large red darken-2">
      <i class="mdi-content-add-circle"></i>
    </a>
  </div>
@endsection