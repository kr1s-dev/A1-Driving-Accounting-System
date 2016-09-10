@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
  	<div class="container">
    	<div class="section">
      		<!--DataTables example-->
  			<div id="table-datatables">
    			<h4 class="header">{{sprintf("%'.07d\n", $eAccountTitle->id)}} | {{$eAccountTitle->account_title_name}}</h4>
    			<div class="row">
      				<div class="col s12 m12 l12">
        				<!--Basic Form-->
        				<div id="basic-form" class="section">
          					<div class="row">
            					<div class="col s12 m12 l12">
              						<div class="card-panel">
                						<h4 class="header2">Account Title Information</h4>
                            <div class="row right-align">
                              @if($eAccountTitle->account_title_id == NULL)
                                <div class="col l9 m12 s12 right-align">
                                  <a href="{{route('accounttitle.with.parent.accounttitle',$eAccountTitle->id)}}" class="btn waves-effect waves-light cyan" type="submit" name="action">Add Contra {{$eAccountTitle->group->account_group_name}}
                                      <i class="mdi-action-receipt left"></i>
                                  </a>
                                </div>
                              @endif
                              @if(Auth::user()->user_type_id==1)
                                <div class="col l3 m12 s12 right-align">
                                  {!! Form::model($eAccountTitle, ['method'=>'DELETE','action' => ['AccountTitles\AccountTitleController@destroy',$eAccountTitle->id] , 'class' => 'form-horizontal form-label-left form-wrapper']) !!}
                                    <button type="submit" class="btn waves-effect waves-light cyan" onclick="return confirm('Are you sure you want to delete this record?');"><i class="material-icons left">highlight_off</i> Delete Account Title</button>
                                  {!! Form::close() !!}
                                </div>
                              @endif
                            </div>
                						<div class="row">
                  							<div class="col l3 m3 s12">
                    							<h6><strong>Account Group</strong></h6>
                  							</div>
                  							<div class="col l3 m3 s12">
                								<h6>
                  									{{$eAccountTitle->group->account_group_name}}
                								</h6>
                      						</div>
                    					</div>
                    					<div class="divider"></div>
                    					<div class="row">
                  							<div class="col l3 m3 s12">
                        						<h6><strong>Account Title Name</strong></h6>
                      						</div>
                      						<div class="col l3 m3 s12">
                        						<h6>{{$eAccountTitle->account_title_name}}</h6>
                      						</div>
                    					</div>
                    					<div class="divider"></div>
                    					@if($eAccountTitle->group->account_group_name != 'Revenues' && $eAccountTitle->group->account_group_name != 'Expenses')
	                    					<div class="row">
	                  							<div class="col l3 m3 s12">
	                        						<h6><strong>Opening Balance</strong></h6>
	                      						</div>
	                      						<div class="col l3 m3 s12">
	                        						<h6>{{$eAccountTitle->opening_balance}}</h6>
	                      						</div>
	                    					</div>
	                    					<div class="divider"></div>
                    					@endif
                    					<div class="row">
                  							<div class="col l3 m3 s12">
                        						<h6><strong>Description</strong></h6>
                      						</div>
                      						<div class="col l3 m3 s12">
                        						<h6>{{$eAccountTitle->description}}</h6>
                      						</div>
                    					</div>
                    					<div class="divider"></div>
                  					</div>
                				</div>
              				</div>
                      @if($eAccountTitle->group->account_group_name == 'Revenues' ||       strpos($eAccountTitle->group->account_group_name,'Revenues') ||
                          $eAccountTitle->group->account_group_name == 'Expenses' || strpos($eAccountTitle->group->account_group_name,'Expenses'))
                        <div class="row">
                          <div class="col l12 m12 s12">
                              <div class="card-panel">
                                <h4 class="header2">Account Title Items </h4>
                              <div class="row right-align">
                                <div class="col l12 m12 s12">
                                  <a href="{{ route('item.create',$eAccountTitle->id) }}" class="btn waves-effect waves-light cyan" type="submit" name="action">Add Item
                                      <i class="mdi-action-receipt right"></i>
                                  </a>
                                </div>
                              </div>
                              <br>
                                <div class="row">
                                    <table class="striped" id="courseFeeList">
                                      <thead>
                                          <tr>
                                            <th>Item Name</th>
                                            <!--th>Default Value</th-->
                                            <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($itemList as $item)
                                          <tr>
                                            <td>{{$item->item_name}}</td>
                                            <!--td>PHP {{number_format($item->default_value,2)}}</td-->
                                            <td>
                                              <a href="{{route('item.edit',$item->id)}}" style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4">
                                                <i class="mdi-content-create"></i>
                                              </a>
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                </div>
                                <br>
                              </div>
                          </div>
                        </div>
                      @endif
              				
            			</div>
          			</div>
        		</div>
        		<br>
      		</div>
    	</div>
  	</div>
  <!--end container-->
@endsection