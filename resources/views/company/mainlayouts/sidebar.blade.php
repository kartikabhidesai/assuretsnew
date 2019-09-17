@php
$currRoute = Route::current()->getName();
$details=Auth::guard('company')->user();
@endphp

<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" style="width: 50px;height: 50px;" src="{{ url('public/uploads/userprofile/'.$details->profile_image)}}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $details->firstname}} {{ $details->lastname}}</strong>
                             </span> <span class="text-muted text-xs block">{{ $details->role_type}} <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ url('viewprofile-company') }}">View Profile</a></li>
                                <li><a href="{{ url('updateprofile-company') }}">Update Profile</a></li>
                                <li><a href="{{ url('changepassword-company') }}">Change Password</a></li>
                                <li><a href="{{ url('changeprofilepicture-company') }}">Change Profile Picture</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    
                    <li class="{{ ($currRoute == 'addservice-company' || $currRoute == 'customermydetailservice' || $currRoute == 'company-serivces')  ? 'active' : '' }} ">
                        <a href="{{ url('company-serivces') }}"><i class="fa fa-users"></i> <span class="nav-label">My Services</span></a>
                    </li>
                    
                    <li class="{{ ($currRoute == 'customerdetailservice' || $currRoute == 'company-list')  ? 'active' : '' }} ">
                        <a href="{{ url('company-list') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Services</span></a>
                    </li>
                    
                     <li  class="{{ ($currRoute == 'customerhistory')    ? 'active' : '' }} ">
                        <a href="{{ url('customerhistory') }}"><i class="fa fa-history"></i> <span class="nav-label">History</span></a>
                    </li>
                    
                </ul>
            </div>
        </nav>

