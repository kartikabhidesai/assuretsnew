@extends('admin.mainlayouts.index')
@section('title','User-list')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Userlist</h5>
                    <div class="ibox-tools">
                        <a class="close-link" title="Add User" data-toggle="tooltip" data-placement="left" href="{{ url('userform') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="rickshaw_scatterplot" class="rickshaw_graph">
                       <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="datatableUser">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Mobile Number</th>
                                        <th>Role type</th>
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
