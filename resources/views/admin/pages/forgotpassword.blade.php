@extends('admin.loginlayouts.login-index')
@section('title', 'Forgot Password')
@section('content')
            <div>
               
            </div>
            <h3>Reset your password Here</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="m-t" role="form" action="" id="forgotpassword" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username or Email address" />
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Sent Mail</button>

                <a href="{{ url('login') }}"><small>Back to Login</small></a>
            </form>
        
@endsection    