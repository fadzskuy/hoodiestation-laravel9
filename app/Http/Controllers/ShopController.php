<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request, $id = null)
    {
        $categories = Category::all();
        // $products = product::where('name', 'LIKE', '%'.$request->search.'%')->orWhere('price', 'LIKE', '%'.$request->search.'%')->paginate(8);
        $products = Product::query();
        if (!empty($request->search)) {
            $search = $request->search;
            $products->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('price', $search);
            });
        }
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
            $products->where('price', '>=', $min_price);
        }
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
            $products->where('price', '<=', $max_price);
        }
        $products = $products->paginate(8);
        if ($products->isEmpty()) {
            $message = 'Maaf Produk yang Anda cari tidak tersedia.';
            return view('shop.index', compact('message'));
        }
        return view('shop.index', compact('products', 'categories', 'id'));
    }
    public function category($id)
    {
        $categories = Category::all();
        $products = product::where('category_id', $id)->paginate(8);
        return view('shop.index', compact('products','categories', 'id'));
    }
    public function show(Product $product, $id)
    {
        $sizes = Size::all();
        $data = Product::findOrFail($id);
        return view('shop.show', compact('data', 'sizes'));
    }
    public function detail($id)
    {
        $sizes = Size::all();
        $data = Product::findOrFail($id);
        return view('shop.detail', compact('data', 'sizes'));
    }
}
