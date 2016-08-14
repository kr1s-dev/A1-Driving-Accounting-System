@extends('master_layout.master_page_layout')
@section('content')
	<!--start container-->
	<div class="container account-entries">
      <div class="section">
          <div id="table-datatables">
            <h4 class="header">Account Titles</h4>
            <div class="row">
               <div class="col l12 right-align">
                  <a href="{{route('accounttitle.create')}}" class="waves-effect waves-light blue btn"><i class="mdi-content-add left"></i>Create New Title</a>
               </div>
            </div>
            <div class="row">
               <div class="col s12 m12 l12">
                  <table class="responsive-table bordered display journal-entries" cellspacing="0">
                     <thead>
                        <tr>
                           <th colspan="2">Account Title</th>
                           <th width="20%">Opening Balance</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td colspan="3"><strong>Assets</strong></td>
                        </tr>
                        @foreach($taccountGroupList as $accountGroup)
                           @if(strpos($accountGroup->account_group_name, 'Asset'))
                              <tr>
                                 <td colspan="3" style="text-indent: 30px;"><strong>{{$accountGroup->account_group_name}}</strong></td>
                              </tr> 
                              @foreach($accountGroup->accountTitles as $accountTitle)
                                 @if(is_null($accountTitle->account_title_id))
                                    <tr>
                                       <td colspan="2" style="text-indent: 50px;">
                                          <a href="{{ route('accounttitle.show',$accountTitle->id) }}">
                                             {{$accountTitle->account_title_name}}
                                          </a>
                                       </td>
                                       <td >
                                          {{$accountTitle->opening_balance}}
                                       </td>
                                    </tr>
                                    @foreach($accountTitle->accountTitleChildren as $accountTitlechild)
                                       <tr>
                                          <td colspan="2" style="text-indent: 70px;">
                                             <a href="{{ route('accounttitle.show',$accountTitlechild->id) }}">
                                                {{$accountTitlechild->account_title_name}}
                                             </a>
                                          </td>
                                          <td >
                                             
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              @endforeach
                              <tr>
                                 <td colspan="3" style="text-indent: 50px;">
                                    <a href="{{route('accounttitle.with.parent.accountgroup',$accountGroup->id)}}"><strong><u><em>Add {{$accountGroup->account_group_name}}</em></u></strong></a>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                        <tr>
                           <td colspan="3"><strong>Liabilities</strong></td>
                        </tr>
                        @foreach($taccountGroupList as $accountGroup)
                           @if(strpos($accountGroup->account_group_name, 'Liabilities'))
                              <tr>
                                 <td colspan="3" style="text-indent: 30px;"><strong>{{$accountGroup->account_group_name}}</strong></td>
                              </tr> 
                              @foreach($accountGroup->accountTitles as $accountTitle)
                                 @if(is_null($accountTitle->account_title_id))
                                    <tr>
                                       <td colspan="2" style="text-indent: 50px;">
                                          <a href="{{ route('accounttitle.show',$accountTitle->id) }}">
                                             {{$accountTitle->account_title_name}}
                                          </a>
                                       </td>
                                       <td >
                                          {{$accountTitle->opening_balance}}
                                       </td>
                                    </tr>
                                    @foreach($accountTitle->accountTitleChildren as $accountTitlechild)
                                       <tr>
                                          <td colspan="2" style="text-indent: 70px;">
                                             <a href="{{ route('accounttitle.show',$accountTitlechild->id) }}">
                                                {{$accountTitlechild->account_title_name}}
                                             </a>
                                          </td>
                                          <td >
                                             
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              @endforeach
                              <tr>
                                 <td colspan="3" style="text-indent: 50px;">
                                    <a href="{{route('accounttitle.with.parent.accountgroup',$accountGroup->id)}}"><strong><u><em>Add {{$accountGroup->account_group_name}}</em></u></strong></a>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                        <tr>
                           <td colspan="3"><strong>Owner's Equity</strong></td>
                        </tr>
                        @foreach($taccountGroupList as $accountGroup)
                           @if(strpos($accountGroup->account_group_name, 'Equity'))
                              <tr>
                                 <td colspan="3" style="text-indent: 30px;"><strong>{{$accountGroup->account_group_name}}</strong></td>
                              </tr> 
                              @foreach($accountGroup->accountTitles as $accountTitle)
                                 @if(is_null($accountTitle->account_title_id))
                                    <tr>
                                       <td colspan="2" style="text-indent: 50px;">
                                          <a href="{{ route('accounttitle.show',$accountTitle->id) }}">
                                             {{$accountTitle->account_title_name}}
                                          </a>
                                       </td>
                                       <td >
                                          {{$accountTitle->opening_balance}}
                                       </td>
                                    </tr>
                                    @foreach($accountTitle->accountTitleChildren as $accountTitlechild)
                                       <tr>
                                          <td colspan="2" style="text-indent: 70px;">
                                             <a href="{{ route('accounttitle.show',$accountTitlechild->id) }}">
                                                {{$accountTitlechild->account_title_name}}
                                             </a>
                                          </td>
                                          <td >
                                             
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              @endforeach
                              <tr>
                                 <td colspan="3" style="text-indent: 50px;">
                                    <a href="{{route('accounttitle.with.parent.accountgroup',$accountGroup->id)}}"><strong><u><em>Add {{$accountGroup->account_group_name}}</em></u></strong></a>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                        <tr>
                           <td colspan="3"><strong>Revenues</strong></td>
                        </tr>
                        @foreach($taccountGroupList as $accountGroup)
                           @if($accountGroup->account_group_name == 'Revenues')
                              @foreach($accountGroup->accountTitles as $accountTitle)
                                 @if(is_null($accountTitle->account_title_id))
                                    <tr>
                                       <td colspan="2" style="text-indent: 50px;">
                                          <a href="{{ route('accounttitle.show',$accountTitle->id) }}">
                                             {{$accountTitle->account_title_name}}
                                          </a>
                                       </td>
                                       <td>
                                          -
                                       </td>
                                    </tr>
                                    @foreach($accountTitle->accountTitleChildren as $accountTitlechild)
                                       <tr>
                                          <td colspan="2" style="text-indent: 70px;">
                                             <a href="{{ route('accounttitle.show',$accountTitlechild->id) }}">
                                                {{$accountTitlechild->account_title_name}}
                                             </a>
                                          </td>
                                          <td >
                                             -
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              @endforeach
                              <tr>
                                 <td colspan="3" style="text-indent: 50px;">
                                    <a href="{{route('accounttitle.with.parent.accountgroup',$accountGroup->id)}}"><strong><u><em>Add {{$accountGroup->account_group_name}}</em></u></strong></a>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                        <tr>
                           <td colspan="3"><strong>Expenses</strong></td>
                        </tr>
                        @foreach($taccountGroupList as $accountGroup)
                           @if($accountGroup->account_group_name == 'Expenses')
                              @foreach($accountGroup->accountTitles as $accountTitle)
                                 @if(is_null($accountTitle->account_title_id))
                                    <tr>
                                       <td colspan="2" style="text-indent: 50px;">
                                          <a href="{{ route('accounttitle.show',$accountTitle->id) }}">
                                             {{$accountTitle->account_title_name}}
                                          </a>
                                       </td>
                                       <td>
                                          -
                                       </td>
                                    </tr>
                                    @foreach($accountTitle->accountTitleChildren as $accountTitlechild)
                                       <tr>
                                          <td colspan="2" style="text-indent: 70px;">
                                             <a href="{{ route('accounttitle.show',$accountTitlechild->id) }}">
                                                {{$accountTitlechild->account_title_name}}
                                             </a>
                                          </td>
                                          <td >
                                             -
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              @endforeach
                              <tr>
                                 <td colspan="3" style="text-indent: 50px;">
                                    <a href="{{route('accounttitle.with.parent.accountgroup',$accountGroup->id)}}"><strong><u><em>Add {{$accountGroup->account_group_name}}</em></u></strong></a>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         
      </div>
   </div>
<!--end container-->
@endsection