@extends('layouts.app')

@section('title', 'Keranjang Saya - FDRIX')

@section('content')
<div class="page-container" style="max-width: 1100px;">
    <h1 class="cart-title">Keranjang Saya</h1>

    @if(isset($cartItems) && count($cartItems) > 0)
        <div class="cart-page-wrapper">
            <div class="cart-items-list">
                @php $total = 0; @endphp
                @foreach($cartItems as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <div class="cart-item-card" data-id="{{ $id }}">
                        <img src="{{ asset($details['image']) }}" onerror="this.onerror=null;this.src='https://placehold.co/100x100/e5e5c0/6f8a2f?text=Image';" alt="{{ $details['name'] }}" class="cart-item-image">
                        
                        <div class="cart-item-details">
                            <h2>{{ $details['name'] }}</h2>
                            <p class="cart-item-price" data-price="{{ $details['price'] }}">Rp{{ number_format($details['price'], 0, ',', '.') }}</p>
                        </div>

                        <div class="cart-item-quantity">
                            <input type="number" value="{{ $details['quantity'] }}" min="1" class="quantity-input" data-id="{{ $id }}">
                        </div>

                        <div class="cart-item-subtotal">
                            <span id="subtotal-{{ $id }}">Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                        </div>

                        <div class="cart-item-remove">
                            <button class="remove-item-btn" data-id="{{ $id }}" title="Hapus item">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h2>Ringkasan Belanja</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="summary-total">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="action-button save" style="width: 100%; text-align:center; margin-top: 20px; text-decoration: none;">Lanjut ke Checkout</a>
            </div>
        </div>
    @else
        {{-- TAMPILAN JIKA KERANJANG KOSONG --}}
        <div class="empty-cart-container">
            <div class="empty-cart-icon"><i class="fas fa-shopping-cart"></i></div>
            <h2>Wah, keranjang belanjamu masih kosong</h2>
            <p>Yuk, telusuri promo menarik dari FDRIX!</p>
            <a href="{{ route('store') }}" class="action-button save" style="text-decoration: none;">Belanja Sekarang</a>
        </div>
    @endif

    {{-- REKOMENDASI PRODUK --}}
    @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
    <div class="recommendation-section">
        <h2>Kamu Mungkin Juga Suka</h2>
        <div class="product-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            @foreach($recommendedProducts as $product)
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset($product->image) }}" onerror="this.onerror=null;this.src='https://placehold.co/200x200/d9e9a3/6f8a2f?text=Produk';" alt="{{ $product->name }}">
                    <div class="price-tag">Rp{{ number_format((int) filter_var($product->price, FILTER_SANITIZE_NUMBER_INT), 0, ',', '.') }}</div>
                </div>
                <a href="{{ route('cart.add', $product->id) }}" class="product-name-button add-to-cart-btn" data-id="{{ $product->id }}">Tambah ke Keranjang</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
