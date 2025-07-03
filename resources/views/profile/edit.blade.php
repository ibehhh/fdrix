@extends('layouts.app')

@section('title', 'My Profile - FDRIX')

@section('content')
<div class="profile-page-container">
    
    {{-- Panel untuk Informasi Profil --}}
    <div class="profile-panel">
        <header>
            <h2>Profile Information</h2>
            <p>Update your account's profile information and email address.</p>
        </header>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="input-wrapper"><input type="text" id="name" name="name" class="input-field" value="{{ old('name', $user->name) }}" required></div>
            <div class="input-wrapper"><input type="email" id="email" name="email" class="input-field" value="{{ old('email', $user->email) }}" required></div>
            <div class="form-actions">
                @if (session('status') === 'profile-updated')
                    <p class="form-saved-text">Tersimpan.</p>
                @endif
                <button type="submit" class="action-button save">Save</button>
            </div>
        </form>
    </div>

    {{-- Panel untuk Update Password --}}
    <div class="profile-panel">
        <header>
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>
        </header>
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="input-wrapper"><input placeholder="Current Password" type="password" id="current_password" name="current_password" class="input-field" required></div>
            <div class="input-wrapper"><input placeholder="New Password" type="password" id="password" name="password" class="input-field" required></div>
            <div class="input-wrapper"><input placeholder="Confirm New Password" type="password" id="password_confirmation" name="password_confirmation" class="input-field" required></div>
            <div class="form-actions">
                 @if (session('status') === 'password-updated')
                    <p class="form-saved-text">Tersimpan.</p>
                @endif
                <button type="submit" class="action-button save">Save</button>
            </div>
        </form>
    </div>

    {{-- Panel untuk Hapus Akun --}}
    <div class="profile-panel danger-zone">
        <header>
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        </header>
        <button id="delete-account-button" class="action-button danger">Delete Account</button>
    </div>

</div>

{{-- Modal Konfirmasi Hapus Akun (Tersembunyi) --}}
<div id="delete-confirm-modal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h2>Are you sure?</h2>
        <p>This action cannot be undone. This will permanently delete your account. Please type your password to confirm.</p>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <input type="password" name="password" placeholder="Enter your password" class="modal-input" required>
            <div class="modal-actions">
                <button type="button" id="cancel-delete-button" class="action-button secondary">Cancel</button>
                <button type="submit" class="action-button danger">Delete My Account</button>
            </div>
        </form>
    </div>
</div>
@endsection