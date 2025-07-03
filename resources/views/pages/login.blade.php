{{-- Lokasi File: resources/views/pages/login.blade.php --}}

@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="welcome-text">
        <h1>Hi! <br> Welcome</h1>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf {{-- Selalu tambahkan @csrf pada form di Laravel --}}

        <div class="input-wrapper">
            <label for="username">Username Email or Phone Number</label>
            <input type="text" id="username" class="input-field" required>
            <i class="fas fa-user input-icon"></i>
        </div>

        <div class="input-wrapper">
            <label for="password">Password</label>
            <input type="password" id="password" class="input-field" required>
            <i class="fas fa-eye input-icon"></i>
        </div>

        <div class="options-row">
            <div class="remember-me">
                <input type="checkbox" id="remember">
                <label for="remember">Remember Me</label>
            </div>
            <a href="#" class="forgot-password">Forget Password?</a>
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>

<div class="signup-link">
    <p>don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
</div>
</div>
@endsection