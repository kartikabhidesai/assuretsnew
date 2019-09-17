@php
$details=Auth::guard('company')->user();
@endphp
@extends('company.mainlayouts.index')
@section('title', 'Company-list')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Service List</h5>
                    <div class="ibox-tools">
                       <a class="close-link" title="Add Service" data-toggle="tooltip" data-placement="left" href="{{ url('addservice-company') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="rickshaw_scatterplot" class="rickshaw_graph">
                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input class="c-input" type="hidden"  id="userid" value="{{ $details->id}}">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="datatableServices" >
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Service No</th>
                                        <th>Vehicle No</th>
                                        <th>Owner name</th>
                                        <th>Mobile</th>
                                        <th>Location</th>
                                        <th>Insurer</th>
                                        <th>Address</th>
                                        <th>Executive</th>
                                         <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection