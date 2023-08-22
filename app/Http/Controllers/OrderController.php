<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //     public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $order = TransactionDetail::where('status', 'Belum Bayar')
            ->whereHas('transaction', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->with('product')
            ->get();
        $total = 0;
        foreach ($order as $o) {
            $total += ($o->product->price * $o->qty);
        }
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                // 'order_id' => $order->pluck('id')->implode('-'),
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'last_name' =>'',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('midtrans.checkout', compact('snapToken', 'order', 'total'), [
            'title' => 'Hoodie Station'
        ]);
    }
    
    public function checkout()
    {
        $cartUser = Cart::select('carts.*')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', Auth::user()->id)
            ->get();
        
        if ($cartUser->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }
        
        foreach ($cartUser as $cart){
            if ($cart->product->stok <= 0) {
                return redirect('/cart')->with('error', 'Silahkan hapus terlebih dahulu produk yang telah sold out!');
            }
        }
        
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id
        ]);
        
        foreach ($cartUser as $cart){
            $transaction->detail()->create([
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'size_id' => $cart->size_id
            ]);
        }
        
        Cart::where('user_id', Auth::user()->id)->delete();
        
        return redirect('/checkout');
    }
 
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $orders = TransactionDetail::where('id', '>=', 1)->get();
                foreach ($orders as $order) {
                    if ($order && $order->status == 'Sudah Bayar') {
                        continue; // skip pesanan yang sudah dibayar sebelumnya
                    }
                    $order->update(['status' => 'Sudah Bayar']);
                    $product = Product::find($order->product_id);
                    $product->stok -= $order->qty;
                    $product->save();
                }
            }
        }
    }
    
    
    public function invoice()
    {
        $userId = auth()->user()->id;
        $order = TransactionDetail::with('product')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->where(function($query) {
                $query->where('transaction_details.status', '=', 'Sudah Bayar')
                      ->orWhere('transaction_details.status', '=', 'Dibatalkan');
            })
            ->where('transactions.user_id', '=', $userId)
            ->orderBy('transaction_details.created_at', 'desc')
            ->get();
        return view('midtrans.invoice', [
            'order' => $order,
            'title' => 'Hoodie Station'
        ]);
    }    

    public function cancel()
    {
        $userId = auth()->user()->id;
        TransactionDetail::where('status', 'Belum Bayar')
            ->whereHas('transaction', function ($query) use ($userId) {
                $query->where('user_id', '=', $userId);
            })
            ->delete();
    
        return redirect('/cart')->with('error', 'Transaksi telah dibatalkan.');
    }

    public function batal(Request $request)
    {
        if ($request->isMethod('post')) {
            $transactionId = $request->input('id');
            $transaction = TransactionDetail::find($transactionId);
    
            if ($transaction) {
                $transaction->status = 'Dibatalkan';
                $transaction->save();
            }
            Alert::success('Berhasil', 'Pesanan Telah Dibatalkan!');
            return redirect()->back();
        }
    }
}