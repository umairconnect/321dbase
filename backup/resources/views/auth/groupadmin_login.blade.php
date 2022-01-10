@extends('auth.layout', ['title' => 'Login to Wi5 Group Panel'])

@section('content')
<div class="login-form">
    <div class="text-center mb-5">
        <img src="{{ asset('images/logo.png') }}" />
        <h5>LOGIN TO Wi5 GROUP</h5>
    </div>
    @if ($errors->has('login_failed'))
    <div class="alert alert-danger d-flex alert-dismissible fade show">
        {{ $errors->first('login_failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('groupadmin.login') }}" method="POST" id="login-form">
        @csrf
        <div class="login-form-group">
            <label for="login">Group Name</label>
            <input type="text" name="login" id="login" class="login-form-control" value="{{ old('login') }}" />
            @if ($errors->has('login'))
            <span class="text-danger">Please enter group name.</span>
            @endif
        </div>
        <div class="login-form-group mt-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="login-form-control" value="{{ old('password') }}" />
            @if ($errors->has('password'))
            <span class="text-danger">Please enter password.</span>
            @endif
        </div>
        <div class="pt-4 d-flex justify-content-between">
            <label class="color-checkbox primary-color">Remember me
                <input type="checkbox" name="remember" />
                <span class="checkmark"></span>
            </label>
            <a href="">Forgot password?</a>
        </div>
        <button type="submit" class="login-btn mt-5">Log In</button>
    </form>
</div>
@endsection