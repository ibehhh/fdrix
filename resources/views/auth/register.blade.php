@extends('layouts.app')

@section('title', 'Sign Up - FDRIX')

@section('content')
<div class="login-page-wrapper">
    <div class="login-container">
        <div class="welcome-text">
            <h1>Create Your<br>Account</h1>
        </div>

        {{-- Form Pendaftaran --}}
        <form action="{{ route('register') }}" method="POST">
            @csrf

            {{-- Input untuk Nama --}}
            <div class="input-wrapper">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="input-field" value="{{ old('name') }}" required autofocus>
                <i class="fas fa-user input-icon"></i>
            </div>

            {{-- Input untuk Email --}}
            <div class="input-wrapper">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="input-field" value="{{ old('email') }}" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>

            {{-- Input untuk Password --}}
            <div class="input-wrapper">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-field" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            {{-- Input untuk Konfirmasi Password --}}
            <div class="input-wrapper">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            <button type="submit" class="login-btn">Sign Up</button>
        </form>

        {{-- Link untuk ke Halaman Login --}}
        <div class="signup-link">
            <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </div>
</div>
@endsection