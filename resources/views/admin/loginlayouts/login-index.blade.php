<!DOCTYPE html>
<html>

    @include('admin.loginlayouts.login-header')

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>

                @yield('content')

                @include('admin.loginlayouts.login-footer')

            </div>
        </div>
    </body>

</html>

