@extends('admin.mainlayouts.index')
@section('title','Edit-service-form')
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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Service</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id" name="id" value="{{ $getServiceData['id'] }}">
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Service No</label>
                            <div class="col-md-6 control-label">
                                {{ $getServiceData['service_no'] }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Owner Name</label>
                            <div class="col-md-6 control-label">
                                {{ $getServiceData['owner_name'] }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Owner Mobile</label>
                            <div class="col-md-6">
                                {{ $getServiceData['owner_mobile'] }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Location</label>
                            <div class="col-md-6">
                                {{ $getServiceData['location'] }}
                            </div>
                        </div>
                      
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Insurer</label>
                            <div class="col-md-6">
                                
                                {{ $getServiceData['firstname'].' '.$getServiceData['lastname'] }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Vehicle No</label>
                            <div class="col-md-6">
                                {{ $getServiceData['vehicle_no'] }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label">Address</label>
                            <div class="col-md-6">
                                {{ $getServiceData['address'] }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                             <label class="col-md-6 control-label">Executive</label>
                            <div class="col-md-6">
                                {{ $getServiceData['executivefirstname'].' '.$getServiceData['executivelastname'] }}
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                             <label class="col-md-6 control-label">Engine no </label>
                            <div class="col-md-6">
                                {{ $getServiceData['engine_no'] }}
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                             <label class="col-md-6 control-label">Chession No</label>
                            <div class="col-md-6">
                                {{ $getServiceData['chession_no'] }}
                                
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Service Photo</h5> 
                    <a style="margin-left:10px;" class="pull-right" href="{{ url('/downloadzip/'.$getServiceData['id']) }}" title="Image zip download">
                        <i class="fa fa-cloud-download fa-2x" aria-hidden="true"></i>
                    </a>
                    <a style="margin-left:10px;"  class="pull-right" title="Delete Images">
                        <i class="fa fa-trash-o fa-2x deleteimages" aria-hidden="true"></i>
                    </a>
                     
                    <a class="pull-right" title="Add Images">
                        <span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="Delete">
                                        <i class="fa fa-plus fa-2x Addimages" aria-hidden="true"></i>
                         </span>
                    </a>
                </div>
                
                <div class="ibox-content">
                    <div class="row">
                        @foreach($getServicePhotoDatas as $getServicePhotoData)
                        
                        @php
                            $data = explode(".",$getServicePhotoData['name']);
                            $lastdata = end($data);
                        @endphp
                        @if($lastdata == 'mp4' || $lastdata == '3gp' || $lastdata == 'mkv' || $lastdata == 'flv' || $lastdata == 'gif')
                        <div class="form-group col-md-3">
                            <video width="150" height="150" controls>
                                <source src="{{ url('/public/servicephoto/'.$getServicePhotoData['name']) }}" type="video/mp4">
                                <source src="{{ url('/public/servicephoto/'.$getServicePhotoData['name']) }}" type="video/ogg">
                                 <input type="checkbox" class="form-check image" name="image" value="{{ $getServicePhotoData['id']}}" >
                                Your browser does not support HTML5 video.
                              </video>
                        </div>
                        
                        
                        @else
                        <div class="form-group col-md-3">
                            <div class="lightBoxGallery">                             
                                <a href="{{ url('/public/servicephoto/'.$getServicePhotoData['name']) }}" title="Image from Unsplash" data-gallery=""><img style="width: 150px;height: 150px;" src="{{ url('/public/servicephoto/'.$getServicePhotoData['name']) }}"></a>                              
                                <input type="checkbox" class="form-check image" name="image" value="{{ $getServicePhotoData['id']}}" >
                                
                            </div>
                            <div class="text-center"><a target="_blank" href="https://www.latlong.net/c/?lat={{ $getServicePhotoData['latitude']}}&long={{ $getServicePhotoData['longitude']}}">View Map</a></div>
                            
                        </div>
                        
                        @endif
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>


  <div class="modal fade" id="deleteModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Images</h4>
        </div>
        <div class="modal-body">
           <div class="ibox-content">
                    <form method="post" class="form-horizontal" action="{{ route("addimages")}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="serviceid" value="{{ $id }}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Add File</label>

                                <div class="col-sm-10">
                                    <input type="file" name="filename" class="form-control" required>
                                </div>
                            </div>
                       
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input class="btn btn-primary" name="submit" type="submit"></button>
                                </div>
                            </div>
                    </form>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
@endsection