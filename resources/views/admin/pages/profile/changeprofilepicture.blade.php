
@extends('admin.mainlayouts.index') 
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
                                        @php
                                        $image= $profiledetails[0]["profile_image"] ;
                                        @endphp
                                        <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ url('public/uploads/userprofile/'.$image)}}" style="width:150px;height: 150px;">                                        
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                        <input type="text" placeholder="Enter your first name" value="{{ $profiledetails[0]['id'] }}" name="id" class="form-control hidden" >
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profilepicture" value="" name="profileimage">
                                          <label class="custom-file-label" for="customFile">Choose your profile picture</label>
                                        </div>
                                        <button class="btn  btn-info " type="submit">Change Profile Picture</button>
                                        
                                    </form> 
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