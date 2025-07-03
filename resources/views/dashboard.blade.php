@extends('layouts.app')

@section('title', 'Dashboard - FDRIX')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
        <p>Akses cepat ke semua kebutuhanmu ada di sini.</p>
    </div>

    <div class="dashboard-grid">
        {{-- Card untuk ke Halaman Profil --}}
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <h2>Profil Saya</h2>
            <p>Perbarui informasi akun, email, dan password Anda.</p>
            <a href="{{ route('profile.edit') }}" class="card-button">Kelola Profil</a>
        </div>

        {{-- Card untuk Riwayat Pesanan --}}
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-receipt"></i>
            </div>
            <h2>Riwayat Pesanan</h2>
            <p>Lihat semua transaksi dan pesanan yang pernah Anda buat.</p>
            <a href="#" class="card-button">Lihat Riwayat</a>
        </div>

        {{-- Card untuk Mulai Belanja --}}
        <div class="dashboard-card primary">
            <div class="card-icon">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <h2>Mulai Belanja</h2>
            <p>Jelajahi berbagai macam cemilan dan produk terbaru dari kami.</p>
            <a href="{{ route('store') }}" class="card-button">Pergi ke Toko</a>
        </div>
    </div>
</div>
@endsection