@extends('layouts.app')

@section('title', 'Struk Pembayaran')

@section('content')
<main class="receipt-page-container">
    <div class="title-pill">Pembayaran Berhasil!</div>
    <div class="content-wrapper">
        <img src="https://www.svgrepo.com/show/274649/receipt-invoice.svg" alt="Ikon Struk" class="receipt-icon">
        <div class="printable-receipt">
            <h2>Struk Pembayaran FDRIX</h2>
            <p>================================</p>
            <p><strong>ID Pesanan:</strong> {{ $order->order_id }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i:s') }}</p>
            <p>--------------------------------</p>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>No. Telp:</strong> {{ $order->phone_number }}</p>
            <p>================================</p>
            @php $total = 0; @endphp
            {{-- 
                PERBAIKAN: 
                Looping diubah dari $cartItems menjadi $order->products, 
                karena ini adalah data yang dikirim dari controller.
            --}}
            @foreach($order->products as $product)
                @php 
                    $subtotal = $product->pivot->price * $product->pivot->quantity; 
                    $total += $subtotal; 
                @endphp
                <p>
                    {{ $product->name }} (x{{ $product->pivot->quantity }})
                    <span style="float:right;">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                </p>
            @endforeach
            <p>================================</p>
            <p><strong>TOTAL:</strong> <span style="float:right; font-weight:bold;">Rp{{ number_format($total, 0, ',', '.') }}</span></p>
            <p><strong>Status:</strong> <span style="font-weight:bold;">LUNAS</span></p>
            <p>================================</p>
            <p style="text-align:center;">Terima kasih telah berbelanja!</p>
        </div>
    </div>
    <div class="receipt-actions" style="margin-top: 20px; display: flex; gap: 15px; justify-content: center;">
        <a href="{{ route('home') }}" class="finish-button">Selesai</a>
        <a href="{{ route('receipt.download', ['order' => $order->id]) }}" class="action-button save" style="text-decoration: none;">Unduh PDF</a>
    </div>
</main>
@endsection
