@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="checkout-container">
    <h1 class="checkout-title">Checkout</h1>
    <form class="checkout-main" method="POST" action="{{ route('receipt.generate') }}">
        @csrf {{-- Token Keamanan Laravel, Wajib ada di setiap form POST --}}
        
        {{-- Kolom Kanan: Ringkasan Pesanan --}}
        <section class="total-section">
            <label>Total</label>
            <div class="total-box-items">
                {{-- PERBAIKAN: Menggunakan variabel $cartItems yang dikirim dari controller --}}
                @foreach($cartItems as $id => $details)
                    <div class="cart-item">
                        <span>{{ $details['name'] }} (x{{ $details['quantity'] }})</span>
                        <span>Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="cart-total">
                    <span>Total Harga</span>
                    {{-- PERBAIKAN: Menggunakan variabel $totalPrice yang dikirim dari controller --}}
                    <span>Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>
        </section>

        {{-- Kolom Kiri: Form Detail Pengguna --}}
        <section class="form-section">
            {{-- Input untuk Nama & Alamat ditambahkan agar sesuai dengan controller --}}
            <div class="input-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" value="{{ auth()->user()->name ?? '' }}" required>
            </div>
            <div class="input-group">
                <label for="address">Alamat Lengkap</label>
                <input type="text" id="address" name="address" placeholder="Masukkan alamat pengiriman" required>
            </div>
            <div class="input-group">
                <label for="phone-number">No.Telp</label>
                {{-- PERBAIKAN: name diubah menjadi 'phone_number' agar sesuai validasi controller --}}
                <input type="tel" id="phone-number" name="phone_number" placeholder="Masukkan nomor telepon..." required>
            </div>
            <div class="payment-logos">
                <img src="https://i.imgur.com/Jq2Yt8t.png" alt="Metode Pembayaran">
            </div>
        </section>
        
        <div class="bayar-wrapper">
            <button type="submit" class="bayar-submit-button">Bayar</button>
        </div>
    </form>
</div>
@endsection
