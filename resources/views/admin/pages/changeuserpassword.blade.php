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
                    
                </div>
                <div class="ibox-content">
                    <form method="post" class="form-horizontal" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id }}" class="form-control">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="newpassword" placeholder="Enter new password" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="confirmpassword" placeholder="Enter new cofirm password" class="form-control">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" name="submit" type="submit">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection