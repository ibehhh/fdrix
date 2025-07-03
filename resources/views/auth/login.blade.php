@extends('layouts.app')

@section('title', 'Login - FDRIX')

@section('content')
<div class="login-page-wrapper">
    <div class="login-container">
        <div class="welcome-text">
            <h1>Hi! <br> Welcome</h1>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-wrapper">
                <label for="email">Username Email or Phone Number</label>
                <input type="email" id="email" name="email" class="input-field" required>
                {{-- Icon Pengguna Ditambahkan --}}
                <i class="fas fa-user input-icon"></i>
            </div>

            <div class="input-wrapper">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-field" required>
                {{-- Icon Mata Ditambahkan --}}
                <i class="fas fa-eye input-icon"></i>
            </div>

            <div class="options-row">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
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
</div>
@endsection