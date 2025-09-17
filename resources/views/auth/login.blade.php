@extends('layouts.app')

@section('content')
<div class="brand-logo">
    <img src="{{ asset('images/logo.svg') }}" alt="logo">
</div>
<h4>Hello! let's get started</h4>
<h6 class="font-weight-light">Sign in to continue.</h6>
<form class="pt-3" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}" required>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('forgot.password') }}" class="auth-link text-black">Forgot password?</a>
        </div>
    </div>
</form>
@endsection