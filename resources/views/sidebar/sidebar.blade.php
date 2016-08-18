<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="user-details cyan darken-2">
        <div class="row">
          <div class="col col s4 m4 l4">
            <img src=" {{ URL::asset('images/avatar.jpg')}}" alt="" class="circle responsive-img valign profile-image">
          </div>
          <div class="col col s8 m8 l8">
            <ul id="profile-dropdown" class="dropdown-content">
              <li><a href="../#"><i class="mdi-action-face-unlock"></i> Profile</a>
              </li>
              <li><a href="../#"><i class="mdi-action-settings"></i> Settings</a>
              </li>
              <li class="divider"></li>
              <li><a href="../#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
              </li>
            </ul>
            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="../#" data-activates="profile-dropdown">John Doe<i class="mdi-navigation-arrow-drop-down right"></i></a>
            <p class="user-roal">Administrator</p>
          </div>
        </div>
        </li>
        <li class="bold"><a href="../index.html" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
        </li>
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
                <i class="mdi-social-school"></i> Branches
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
        <li class="li-hover"><div class="divider"></div></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold">
                <a class="collapsible-header waves-effect waves-cyan">
                <i class="mdi-social-school"></i> Students
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
                <i class="mdi-social-school"></i> Invoices
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
                <i class="mdi-social-school"></i> Receipts
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
                <i class="mdi-social-school"></i> Assets
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
                <i class="mdi-social-school"></i> Account Information
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
                <i class="mdi-social-school"></i> Account Titles
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
                <i class="mdi-social-school"></i> Journal Entry
                </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('journal.index')}}">View All</a>
                            </li>
                            <li><a href="{{route('journal.create')}}">Create New Entry</a>
                            </li>
                            
                        </ul>
                    </div>
                </li> 
            </ul>
        </li>

    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>