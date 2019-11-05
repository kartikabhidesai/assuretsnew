@extends('admin.loginlayouts.login-index')

@section('title', 'Login')
@section('content')
            <div>
                <div class="logo d-none d-lg-block">
                    <a href="{{ route('login') }}">
                         <img style="width: 300px;height: 125px;" src="{{ url('public/uploads/AssuretsLogo.png')}}" alt="Logo">
                     </a>
                </div>
            </div>
            <h3>Login Here</h3>
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
                    <input type="text" name="username" class="form-control" placeholder="Username" />
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="{{ url('forgotpassword') }}"><small>Forgot password?</small></a>
            </form>
        
@endsection    