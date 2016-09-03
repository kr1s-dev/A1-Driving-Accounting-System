<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="user-details cyan darken-2">
        <div class="row">
          <div class="col col s4 m4 l4">
            <img src=" {{ URL::asset('images/avatar.jpg')}}" alt="" class="circle responsive-img valign profile-image">
          </div>
          <div class="col col s8 m8 l8">
            <ul id="profile-dropdown" class="dropdown-content">
              <li><a href="{{route('user.show',Auth::user()->id)}}"><i class="mdi-action-face-unlock"></i> Profile</a>
              </li>
              <li class="divider"></li>
              <li><a href="/logout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
              </li>
            </ul>
            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="../#" data-activates="profile-dropdown">{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            <p class="user-roal">{{Auth::user()->userType->type}}</p>
          </div>
        </div>
        </li>
        <li class="bold"><a href="{{route('admin-dashboard')}}" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
        </li>
        
        @if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office))
            <li class="li-hover"><div class="divider"></div></li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-circle"></i> Users</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{route('user.index')}}">View All</a>
                                </li>
                                <li><a href="{{route('user.create')}}">Create New</a>
                                </li>
                            </ul>
                        </div>
                    </li> 
                </ul>
            </li>
            <li class="li-hover"><div class="divider"></div></li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">location_city</i> Branches
                    </a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{route('branches.index')}}">View All</a>
                                </li>
                                <li><a href="{{route('branches.create')}}">Create New</a>
                                </li>
                            </ul>
                        </div>
                    </li> 
                </ul>
            </li>
        @endif
        
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">school</i> Students
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('students.index')}}">View All</a>
                            </li>
                            <li><a href="{{route('students.create')}}">Create New</a>
                            </li>
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">assignment</i> Invoices
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('invoice.index')}}">View All</a>
                            </li>
                            <!--li><a href="{{route('invoice.create')}}">Create New</a>
                            </li-->
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">receipt</i> Receipts
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('receipt.index')}}">View All</a>
                            </li>
                            <!--li><a href="{{route('invoice.create')}}">Create New</a>
                            </li-->
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">attach_money</i> Expenses
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('expense.index')}}">View All</a>
                            </li>
                            <li><a href="{{route('expense.create')}}">Create New</a>
                            </li>
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">directions_car</i> Assets
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('asset.index')}}">View All</a>
                            </li>
                            <li><a href="{{route('asset.create')}}">Create New Asset</a>
                            </li>
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">account_balance</i> Account Information
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('account.details')}}">View Details</a>
                            </li>
                            <!--li><a href="{{route('invoice.create')}}">Create New</a>
                            </li-->
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">folder</i> Account Titles
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('accounttitle.index')}}">View All</a>
                            </li>
                            <!--li><a href="{{route('invoice.create')}}">Create New</a>
                            </li-->
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">account_balance_wallet</i> Journal Entry
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('journal.index')}}">View All</a>
                            </li>
                            <li><a href="{{route('journal.create')}}">Create New Entry</a>
                            </li>
                            <li><a href="{{route('adjustment.create')}}">Create Adjusting Entry</a>
                            </li>
                            
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="material-icons">picture_as_pdf</i> Reports
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('incomestatement')}}">Income Statement</a>
                            </li>
                            <li><a href="{{route('ownersequity')}}">Statement of OE</a>
                            </li>
                            <li><a href="{{route('balancesheet')}}">Balance Sheet</a>
                            </li>
                            <li><a href="{{route('asset.registry')}}">Asset Registry</a>
                            </li>
                            
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>

    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>