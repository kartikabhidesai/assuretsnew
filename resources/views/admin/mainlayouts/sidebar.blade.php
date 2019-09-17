
@php
$currRoute = Route::current()->getName();
$details=Auth::guard('admin')->user();
        
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
                                <li><a href="{{ url('viewprofile') }}">View Profile</a></li>
                                <li><a href="{{ url('updateprofile') }}">Update Profile</a></li>
                                <li><a href="{{ url('changepassword') }}">Change Password</a></li>
                                <li><a href="{{ url('changeprofilepicture') }}">Change Profile Picture</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="{{ ($currRoute == 'userlist') || ($currRoute == 'userform') || ($currRoute == 'edituser')   ? 'active' : '' }} ">
                        <a href="{{ url('userlist') }}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
                    </li>
                    <li  class="{{ ($currRoute == 'detailservice') || ($currRoute == 'services') || ($currRoute == 'addservice') || ($currRoute == 'editservice')   ? 'active' : '' }} ">
                        <a href="{{ url('services') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Services</span></a>
                    </li>
                    
                    <li  class="{{ ($currRoute == 'history')    ? 'active' : '' }} ">
                        <a href="{{ url('history') }}"><i class="fa fa-history"></i> <span class="nav-label">History</span></a>
                    </li>
                    
                    
                </ul>
            </div>
        </nav>

