<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran {{ $order->order_id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #000;
        }
        .printable-receipt {
            width: 320px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin: 0 0 15px 0;
            font-family: 'Verdana', sans-serif;
        }
        p {
            margin: 5px 0;
            font-size: 14px;
        }
        .item-row span:first-child {
            display: inline-block;
        }
        .item-row span:last-child {
            float: right;
        }
        .total-row strong:last-child {
            float: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="printable-receipt">
        <h2>Struk Pembayaran FDRIX</h2>
        <p>================================</p>
        <p><strong>ID Pesanan:</strong> {{ $order->order_id }}</p>
        <p><strong>No. Telp:</strong> {{ $order->phone_number }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i:s') }}</p>
        <p>--------------------------------</p>
        @php $total = 0; @endphp
        @foreach($order->products as $product)
            @php 
                $subtotal = $product->pivot->price * $product->pivot->quantity; 
                $total += $subtotal; 
            @endphp
            <div class="item-row">
                <p>
                    <span>{{ $product->name }} (x{{ $product->pivot->quantity }})</span>
                    <span>Rp {{ number_format($subtotal) }}</span>
                </p>
            </div>
        @endforeach
        <p>================================</p>
        <div class="total-row">
            <p><strong>TOTAL:</strong> <strong style="float:right;">Rp {{ number_format($total) }}</strong></p>
        </div>
        <p><strong>Status:</strong> <span style="font-weight:bold;">LUNAS</span></p>
        <p>================================</p>
        <p class="text-center">Terima kasih telah berbelanja!</p>
    </div>
</body>
</html>