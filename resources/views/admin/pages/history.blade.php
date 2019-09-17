@extends('admin.mainlayouts.index')
@section('title','Service-list')
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
                    <h5>Complete Service List</h5>
                    
                </div>
                <div class="ibox-content">
                    <div id="rickshaw_scatterplot" class="rickshaw_graph">
                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
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
