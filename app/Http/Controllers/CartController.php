<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $recommendedProducts = Product::inRandomOrder()->limit(4)->get(); 

        return view('pages.cart', [
            'cartItems' => $cart,
            'recommendedProducts' => $recommendedProducts
        ]);
    }

    public function add(Product $product, Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => (int) filter_var($product->price, FILTER_SANITIZE_NUMBER_INT),
                "image" => $product->image
            ];
        }

        $request->session()->put('cart', $cart);

        return response()->json([
            'success' => 'Produk berhasil ditambahkan!',
            'cartCount' => count(session('cart'))
        ]);
    }

    /**
     * FUNGSI BARU: Memperbarui kuantitas item di keranjang.
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            // Hitung total baru untuk dikirim kembali
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return response()->json(['success' => true, 'total' => number_format($total, 0, ',', '.')]);
        }
        return response()->json(['success' => false], 404);
    }

    /**
     * FUNGSI BARU: Menghapus item dari keranjang.
     */
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            // Hitung total baru dan jumlah item untuk dikirim kembali
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return response()->json([
                'success' => true, 
                'total' => number_format($total, 0, ',', '.'),
                'cartCount' => count(session('cart'))
            ]);
        }
        return response()->json(['success' => false], 404);
    }
}
