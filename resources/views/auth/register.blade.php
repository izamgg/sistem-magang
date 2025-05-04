@extends('layouts.auth-template')
@section('content-auth')
  <div id="auth-left">
    <div class="auth-logo">
      <a href="index.html"><img src="/template/assets/images/logo/favicon.svg" alt="Logo"></a>
    </div>
    <h1 class="auth-title">Sign Up</h1>
    <p class="mb-5 auth-subtitle">Input your data to register to our website.</p>

    <form action="{{ route('register.post') }}" method="POST">
      @csrf
      <div class="mb-4 form-group position-relative has-icon-left">
        <input type="text" class="form-control form-control-xl" name="name" placeholder="Name"
          value="{{ old('name') }}">
        <div class="form-control-icon">
          <i class="bi bi-person"></i>
        </div>
        @error('name')
          <small class="text-danger">{{ $message }}</small> <br>
        @enderror
      </div>


      <div class="mb-4 form-group position-relative has-icon-left">
        <input type="text" class="form-control form-control-xl" name="email" placeholder="Email"
          value="{{ old('email') }}">
        <div class="form-control-icon">
          <i class="bi bi-envelope"></i>
        </div>
        @error('email')
          <small class="text-danger">{{ $message }}</small> <br>
        @enderror
      </div>


      <div class="mb-4 form-group position-relative has-icon-left">
        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
        <div class="form-control-icon">
          <i class="bi bi-shield-lock"></i>
        </div>
        @error('password')
          <small class="text-danger">{{ $message }}</small> <br>
        @enderror
      </div>



      <button class="mt-5 shadow-lg btn btn-primary btn-block btn-lg" type="submit">Sign Up</button>
    </form>
    <div class="mt-5 text-lg text-center fs-4">
      <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}" class="font-bold">Log
          in</a>.</p>
    </div>
  </div>
@endsection
