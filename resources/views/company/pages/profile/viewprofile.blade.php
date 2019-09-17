
@extends('company.mainlayouts.index')
@section('title','View Profile')
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
                    <h5>View Profile</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-box">
                                
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ url('public/uploads/userprofile/'.$profiledetails[0]['profile_image'])}}" style="width:150px;height: 150px;">                                        
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <h3><strong>{{ $profiledetails[0]['firstname'] }} {{ $profiledetails[0]['lastname'] }}</strong></h3>                                    
                                    <strong>
                                        <p><i class="fa fa-envelope-o">  {{ $profiledetails[0]['email'] }}</i></p>
                                        <p><i class="fa fa-phone">  {{ $profiledetails[0]['mobile'] }}</i></p>
                                        <p><i class="fa fa-user-o">  {{ $profiledetails[0]['username'] }}</i></p>                                        
                                </div>
                                <div class="clearfix"></div>                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection