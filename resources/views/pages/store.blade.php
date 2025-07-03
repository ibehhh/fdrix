{{-- Lokasi File: resources/views/pages/store.blade.php --}}

@extends('layouts.app')

@section('title', 'Toko - FDRIX')

@section('content')
<main class="store-layout">
    <section class="product-grid">
        {{-- Notifikasi untuk pesan sukses atau error --}}
        @if(session('success'))
            <div class="alert-success" style="grid-column: 1 / -1;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error" style="grid-column: 1 / -1;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Ini adalah satu-satunya loop untuk menampilkan produk --}}
        @foreach ($products as $product)
            <div class="product-card">
                <div class="product-image-wrapper">
                    {{-- 
                        PERBAIKAN GAMBAR: 
                        Path gambar langsung diambil dari database karena sudah berisi 'images/products/...'
                    --}}
                    <img src="{{ asset($product->image) }}" onerror="this.onerror=null;this.src='https://placehold.co/300x300/d9e9a3/6f8a2f?text=Produk';" alt="{{ $product->name }}" />
                    <div class="price-tag">Rp{{ number_format((int) filter_var($product->price, FILTER_SANITIZE_NUMBER_INT), 0, ',', '.') }}</div>
                    
                    {{-- Tombol plus icon yang juga bisa menambahkan ke keranjang --}}
                    <a href="{{ route('cart.add', $product->id) }}" class="plus-icon add-to-cart-btn" title="Tambah ke Keranjang">+</a>
                </div>
                
                {{-- Tombol nama produk untuk menambahkan ke keranjang --}}
                <a href="{{ route('cart.add', $product->id) }}" class="product-name-button add-to-cart-btn">
                    {{ $product->name }}
                </a>
            </div>
        @endforeach
    </section>

    <aside class="action-sidebar">
        <a href="{{ route('cart.index') }}" class="action-button pay">Lihat Keranjang</a>
        <a href="{{ route('home') }}" class="action-button cancel">Kembali</a>
    </aside>
</main>
@endsection
