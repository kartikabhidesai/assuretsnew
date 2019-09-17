
@extends('company.mainlayouts.index')
@section('title','Change Password')
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
                    <h5>Change Password</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="">
                           <input type="text" placeholder="Enter your first name" value="{{ $id }}" name="id" class="form-control hidden" >     
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <div class="form-group"><label class="col-lg-2 control-label">Old Password</label>
                          <div class="col-lg-10">
                              <input type="password" placeholder="Enter your old password"  name="oldpassword" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group"><label class="col-lg-2 control-label">New Password</label>
                          <div class="col-lg-10">
                              <input type="password" placeholder="Enter your new  password" name="newpassword" class="form-control" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                          <div class="col-lg-10">
                              <input type="password" placeholder="Enter your new confirm password" name="confirmpassword" class="form-control" >
                          </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn  btn-info " type="submit">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection