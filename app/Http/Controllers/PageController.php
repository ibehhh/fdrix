<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class PageController extends Controller
{
    public function home()
    {
        $snacks = Product::take(4)->get();
        return view('pages.home', compact('snacks'));
    }

    // Diperbaiki untuk menampilkan semua produk di toko
    public function store()
    {
        $products = Product::all();
        return view('pages.store', compact('products'));
    }

    public function login() { return view('pages.login'); }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('store')->with('error', 'Keranjang Anda kosong!');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // PERBAIKAN: Mengirim variabel dengan nama 'cartItems' agar sesuai dengan view
        return view('pages.checkout', ['cartItems' => $cart, 'totalPrice' => $totalPrice]);
    }

    /**
     * FUNGSI YANG DISEMPURNAKAN
     * Validasi disesuaikan untuk menerima nama & alamat dari form checkout.
     */
    public function generateReceipt(Request $request)
    {
        // PERBAIKAN: Validasi disesuaikan dengan field di form checkout
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);
        
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store')->with('error', 'Tidak ada item untuk di-checkout!');
        }

        // PERBAIKAN: Membuat pesanan baru dengan data yang lebih lengkap
        $order = Order::create([
            'order_id' => 'FDRIX-' . strtoupper(uniqid()), // ID Pesanan dibuat di sini agar aman
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'user_id' => auth()->id() // Menyimpan ID user jika sedang login
        ]);

        // Simpan setiap item di keranjang
        foreach ($cart as $id => $details) {
            $order->products()->attach($id, [
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }
        
        $request->session()->forget('cart');
        
        $fullOrder = Order::with('products')->find($order->id);

        return view('pages.receipt', ['order' => $fullOrder]);
    }

    public function downloadReceipt(Order $order)
    {
        $pdf = Pdf::loadView('pages.receipt_pdf', ['order' => $order]);
        $fileName = 'struk-pembayaran-' . $order->order_id . '.pdf';
        return $pdf->download($fileName);
    }
    
    public function faq()
    {
        // ... (logika faq tidak diubah) ...
        return view('pages.faq', ['faqs' => []]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}