<!DOCTYPE html>
<html>
    @include('company.mainlayouts.header')
    <body>
        <div id="wrapper">
            @include('company.mainlayouts.sidebar')
            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    @include('company.mainlayouts.bodyheader')            
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
                @include('company.mainlayouts.bodyfooter')
            </div>
        </div>
        <!-- Mainly scripts -->
        @include('company.mainlayouts.footer')
    </body>
</html>

