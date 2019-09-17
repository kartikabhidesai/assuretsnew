
@extends('admin.mainlayouts.index') 
@section('title','Update Profile')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update Profile</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <input type="text" placeholder="Enter your first name" value="{{ $id }}" name="id" class="form-control hidden" >
                        <div class="form-group"><label class="col-lg-2 control-label">First Name</label>
                          <div class="col-lg-10">
                              <input type="text" placeholder="Enter your first name" value="{{ $profiledetails[0]['firstname'] }}" name="firstname" class="form-control" >
                          </div>
                        </div>
                        
                        <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>
                          <div class="col-lg-10">
                              <input type="text" placeholder="Enter your last name" name="lastname" class="form-control" value="{{ $profiledetails[0]['lastname'] }}" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                          <div class="col-lg-10">
                              <input type="email" placeholder="Enter your email" name="email" class="form-control" value="{{ $profiledetails[0]['email'] }}" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Phone Number</label>
                          <div class="col-lg-10">
                              <input type="text" placeholder="Enter your phone number" name="phonenumber" class="form-control" value="{{ $profiledetails[0]['mobile'] }}" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">User Name</label>
                          <div class="col-lg-10">
                              <input type="text" placeholder="Enter your user name" name="username" class="form-control" value="{{ $profiledetails[0]['username'] }}" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn  btn-info " type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection