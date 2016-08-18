@extends('master_layout.master_page_layout')
@section('content')
	<div class="container">
      <div class="section">

        <!--DataTables example-->
        <div id="table-datatables">
          	<h4 class="header">#{{sprintf("%'.07d\n",$asset->id)}} - {{$asset->asset_name}}</h4>
      		  <div class="row">
        		  <div class="col s12 m12 l12">
            		<!--Basic Form-->
    				    <div id="basic-form" class="section">
      					  <div class="row">
        					<div class="col s12 m12 l12">
          						<div class="card-panel">
            						<h4 class="header2">Asset Information</h4>
            						<div class="row">
              							<div class="input-field col s12">
                							<button class="btn red darken-2 waves-effect waves-light right" type="submit" name="action" style="margin-left:10px;">Disable
                  								<i class="mdi-action-lock left"></i>
                							</button>
                							<a href="{{route('asset.edit',$asset->id)}}" class="btn red darken-2 waves-effect waves-light right"> Edit
                      							<i class="mdi-content-create left"></i>
                      						</a>
              							</div>
            						</div>
            						<div class="row">
                      					<div class="col s12">
                        					<div class="row">
                          						<div class="col s12 m6 l6">
					                                <label for=""><h6>Description</h6></label>
					                                <h5>{{$asset->asset_desc}}</h5>
                          						</div>
                          						<div class="col s12 m6 l6">
                            						<label for=""><h6>Date Acquired</h6></label>
                            						<h5>{{date('m-d-Y',strtotime($asset->asset_date_acquired))}}</h5>
                          						</div>
                        					</div>
                        					<div class="row">
                          						<div class="col s12 m6 l6">
                            						<label for=""><h6>Vendor</h6></label>
                            						<h5>{{$asset->asset_vendor}}</h5>
                          						</div>
                          						<div class="col s12 m6 l6">
                            						<label for=""><h6>Original Cost</h6></label>
                            						<h5>₱ {{number_format($asset->asset_original_cost,2)}}</h5>
                          						</div>
                        					</div>
                        					<div class="row">
                              					<div class="col s12 m6 l6">
                            						<label for=""><h6>Salvage Value</h6></label>
                            						<h5>{{number_format($asset->asset_salvage_value,2)}}</h5>
                          						</div>
                          						<div class="col s12 m6 l6">
                            						<label for=""><h6>Lifespan (mos)</h6></label>
                            						<h5>₱ {{$asset->asset_lifespan,2}}</h5>
                          						</div>
                        					</div>
                        					<div class="row">
                              					<div class="col s12 m6 l6">
                            						<label for=""><h6>Mode of Acquisition</h6></label>
                            						<h5>{{$asset->asset_mode_of_acq}}</h5>
                          						</div>
                          						@if($asset->asset_mode_of_acq === 'Both')
                          							<div class="col s12 m6 l6">
	                            						<label for=""><h6>Down Payment</h6></label>
	                            						<h5>₱ {{$asset->asset_down_payment,2}}</h5>
	                          						</div>
                          						@endif
                          						
                        					</div>
                        					<div class="row">
                              					<div class="col s12 m6 l6">
                            						<label for=""><h6>Monthly Depreciation</h6></label>
                            						<h5>{{number_format($asset->monthly_depreciation,2)}}</h5>
                          						</div>
                          						<div class="col s12 m6 l6">
                            						<label for=""><h6>Net Value</h6></label>
                            						<h5>{{number_format($asset->net_value,2)}}</h5>
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
@endsection