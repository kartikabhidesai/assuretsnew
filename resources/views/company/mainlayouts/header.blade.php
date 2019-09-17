<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ASSURETS | @yield('title')</title>

    <link href="{{ url('public/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ url('public/admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ url('public/admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ url('public/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('public/admin/css/style.css') }}" rel="stylesheet">
@if (!empty($css)) 
        @foreach ($css as $value) 
        <link rel="stylesheet" href="{{ url('public/css/'.$value) }}">
        @endforeach
    @endif
    
    <script>
        var baseurl = "{{ asset('/') }}";
    </script>
</head>