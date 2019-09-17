@extends('admin.mainlayouts.index')   
@section('title','Edit-user-form')
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
                    <h5>User Detail Form</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" class="form-horizontal" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group"><label class="col-sm-2 control-label">First name</label>

                            <div class="col-sm-10"><input type="text" name="firstname" value="{{ $getupdateData['firstname'] }}" class="form-control"></div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Last name</label>

                            <div class="col-sm-10"><input type="text" name="lastname" value="{{ $getupdateData['lastname'] }}" class="form-control"></div>
                        </div>

                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10"><input type="email" name="email" value="{{ $getupdateData['email'] }}" class="form-control"></div>
                        </div>

                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10"><input type="text" name="username" value="{{ $getupdateData['username'] }}" class="form-control"></div>
                        </div>


                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Mobile</label>

                            <div class="col-sm-10"><input type="text" name="mobile" value="{{ $getupdateData['mobile'] }}" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Role Type</label>
<?php
$role_type=$getupdateData['role_type'];

?>
                            <div class="col-sm-10">
                            <select class="form-control m-b" name="role_type">
                                
                                <option value="company" <?php if($role_type=='company'){ echo("selected='selected'");}?>>Company</option>
                                <option value="user" <?php if($role_type=='user'){ echo("selected='selected'");}?>>User</option>
                                
                               
                                </select>         
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" name="submit" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection