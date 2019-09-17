@extends('admin.loginlayouts.login-index')

@section('title','Register')
@section('content')
<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="m-t" role="form" action="" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" />
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" />
                </div>
                 <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" />
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" />
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                </div>
                <div class="form-group">
                    <input type="text" name="mobile" class="form-control" placeholder="Mobile" />
                </div>
                <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox" name="terms-and-condition"><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ url('login') }}">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
@endsection