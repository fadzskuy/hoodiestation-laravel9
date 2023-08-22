<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HistoryController extends Controller
{
    public function index()
    {
        $transactionDetails = DB::table('transaction_details')
        ->select(
            'transaction_details.*', 
            'users.name', 
            'products.name AS product_name', 
            'products.image AS product_image', 
            'products.price AS product_price',
            'sizes.name AS size_name' // select the name column from sizes table
        )
        ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->join('sizes', 'sizes.id', '=', 'transaction_details.size_id') // join with the sizes table
        ->get();
    
        return view('admin.history', compact('transactionDetails'));
    }
    
    public function historypdf()
    {
        $transactionDetails = DB::table('transaction_details')
            ->select(
                'transaction_details.*', 
                'users.name', 
                'products.name AS product_name', 
                'products.image AS product_image', 
                'products.price AS product_price',
                'sizes.name AS size_name'
            )
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->join('products', 'products.id', '=', 'transaction_details.product_id')
            ->join('sizes', 'sizes.id', '=', 'transaction_details.size_id')
            ->get();
    
        $pdf = PDF::loadView('admin.historypdf', compact('transactionDetails'));
        $pdf->setPaper('A4', 'potrait');
    
        $filename = 'Laporan Transaksi.pdf'; // Nama file yang diinginkan
    
        // Menggunakan download() untuk menghasilkan unduhan langsung
        // Menggunakan save() untuk menyimpan file PDF dengan nama yang diinginkan
        return $pdf->download($filename);
    }
}
