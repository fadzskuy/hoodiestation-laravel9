<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $productId = $request->product_id;
        $product = Product::find($productId);
    
        $sizeId = $request->size ? $request->size : 1; // Mengambil size yang dipilih atau size_id 1 jika tidak ada yang dipilih
    
        $duplicate = Cart::where('user_id', $userId)->where('product_id', $productId)->where('size_id', $sizeId)->first();
        if ($duplicate) {
            Alert::error('Gagal !', 'Produk sudah ada di keranjang!');
            return redirect()->back();
        }
    
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'qty' => 1,
            'size_id' => $sizeId,
        ]);
        Alert::success('Berhasil !', 'Produk berhasil ditambahkan dikeranjang!');
        return redirect()->back();
    }
    

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart.index', compact('carts'), [
            'title' => 'Hoodie Station'
        ]);
    }

    public function delete($id)
    {
        DB::table('carts')->where('id', $id)->delete();
        return redirect('cart');
    }

    public function tambah (Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->product_id = $request->input('product_id');

        $availableStok = $cart->product->stok;

        if ($request->input('qty') > $availableStok) {
            return redirect('/cart')->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        $cart->qty = $request->input('qty');
        $cart->update();

        return redirect('/cart');
    }

    public function kurang (Request $request, $id)
    {
        $cart = Cart::find($id);
        if($cart->qty > 1) {
            $cart->product_id = $request->input('product_id');
            $cart->qty = $request->input('qty');
            $cart->update();
            return redirect('/cart');
        }else{
            return redirect('/cart')->with('error', 'Kuantitas minimal 1');
        }
    }
}
