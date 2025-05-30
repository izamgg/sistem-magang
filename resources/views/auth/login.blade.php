@extends('layouts.auth-template')
@section('content-auth')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div id="auth-left">
        <div class="auth-logo">
            <a href="index.html"><img src="/template/assets/images/logo/favicon.svg" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Log in.</h1>
        <p class="mb-5 auth-subtitle">Log in with your data that you entered during registration.</p>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4 form-group position-relative has-icon-left">
                <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
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
            <div class="form-check form-check-lg d-flex align-items-end">
                <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                <label class="text-gray-600 form-check-label" for="flexCheckDefault">
                    Keep me logged in
                </label>
            </div>
            <button class="mt-5 shadow-lg btn btn-primary btn-block btn-lg" type="submit">Log in</button>
            <!-- Tambahkan tombol untuk kembali ke halaman welcome -->
            <a href="{{ route('welcome') }}" class="mt-3 shadow-lg btn btn-primary btn-block btn-lg">kembali</a>
        </form>
        <div class="mt-5 text-lg text-center fs-4">
            <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign
                    up</a>.</p>
        </div>

    </div>
@endsection
