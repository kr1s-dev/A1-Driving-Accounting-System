@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
        <div class="section">
            <!--DataTables example-->
            <div id="table-datatables">
              	<h4 class="header">#{{sprintf("%'.07d\n",$branch->id)}} - {{$branch->branch_name}}</h4>
              	<div class="row">
                	<div class="col s12 m12 l12">
                    <!--Basic Form-->
            			<div id="basic-form" class="section">
              				<div class="row">
                				<div class="col s12 m12 l12">
                  					<div class="card-panel">
                    					<div class="row">
                      						<div class="input-field col s12">
                        						<!--button class="btn red darken-2 waves-effect waves-light right" type="submit" name="action" style="margin-left:10px;">Disable
                          							<i class="mdi-action-lock left"></i>
                        						</button-->
                        						<a href="{{route('branches.edit',$branch->id)}}" class="btn cyan waves-effect waves-light right">Edit
                        							<i class="mdi-content-create left"></i>
                        						</a>
                        						<!--button class="btn cyan waves-effect waves-light right" type="submit" name="action">Edit
                          							<i class="mdi-content-create left"></i>
                        						</button-->
                      						</div>
                    					</div>
                    					<h4 class="header2">Branch Information</h4>
                    					<div class="row">
                              				<div class="col s12">
                                				<div class="row">
                                  					<div class="col s12 m6 l6">
                                    					<label for=""><h6>Branch Name</h6></label>
                                    					<h5>{{$branch->branch_name}}</h5>
                                  					</div>
                                  					<div class="col s12 m6 l6">
                                    					<label for=""><h6>Address</h6></label>
                                    					<h5>{{$branch->branch_address}}</h5>
                                  					</div>
                                				</div>
                                
                                				<div class="row">
                                  					<div class="col s12 m6 l6">
                                    					<label for=""><h6>Office Number</h6></label>
                                    					<h5>{{$branch->branch_tel_number}}</h5>
                                  					</div>
                                  					<div class="col s12 m6 l6">
                                    					<label for=""><h6>Is this the main office?</h6></label>
                                    					<h5>
                                    						@if($branch->main_office)
                                    							Yes
                                    						@else
                                    							No
                                    						@endif
                                    					</h5>
                                  					</div>
                                				</div>
                              				</div>
                            			</div>
                          			</div>
                        		</div>
                  			</div>
                		</div>
              		</div>
            	</div> 
            	<br>
        	</div>
        </div>
    </div>
@endsection