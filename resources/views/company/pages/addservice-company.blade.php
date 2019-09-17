@php
$details=Auth::guard('company')->user();

@endphp
@extends('company.mainlayouts.index')
@section('title', 'Company-list')

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
                    <h5>Service Form</h5>
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
                        <div class="form-group"><label class="col-sm-2 control-label">Service No</label>

                            <div class="col-sm-10"><input type="text" value="{{ uniqid() }}" name="service_no" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Vehicle No</label>

                            <div class="col-sm-10"><input type="text" name="vehicle_no" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Owner Name</label>

                            <div class="col-sm-10"><input type="text" name="owner_name" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Owner Mobile</label>

                            <div class="col-sm-10"><input type="text" name="owner_mobile" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Location</label>

                            <div class="col-sm-10"><input type="text" name="location" class="form-control"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Insurer</label>

                            <div class="col-sm-10">
                                
                                <select class="form-control m-b" id="insurer" name="insurer" >
                                    <option value="">Select Company</option>
                                    <option value="{{ $details['id'] }}" selected="selected">{{ $details['firstname'] }} {{ $details['lastname'] }}</option>
                                </select>               
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-10"><input type="text" name="address" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Executive</label>

                            <div class="col-sm-10">
                                <select class="form-control m-b" id="user_id" name="user_id" >
                                    <option value="1" >Admin Admin</option>
                                </select> 
                                
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" name="submit" type="submit">Add Details</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection