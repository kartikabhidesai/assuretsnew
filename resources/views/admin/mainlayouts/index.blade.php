<!DOCTYPE html>
<html>
    @include('admin.mainlayouts.header')
    <body>
        <div id="wrapper">
            @include('admin.mainlayouts.sidebar')
            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    @include('admin.mainlayouts.bodyheader')            
                </div>
                @yield('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrapper wrapper-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ibox float-e-margins">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.mainlayouts.bodyfooter')
            </div>
        </div>
        <!-- Mainly scripts -->
        @include('admin.mainlayouts.footer')
    </body>
</html>

