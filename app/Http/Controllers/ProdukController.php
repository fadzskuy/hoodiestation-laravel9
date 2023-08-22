<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index(Request $request, $id = null)
    {
        $categories = Category::all();
        // $products = product::where('name', 'LIKE', '%'.$request->search.'%')->orWhere('price', 'LIKE', '%'.$request->search.'%')->get();
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
        $products = $products->get();
        if ($products->isEmpty()) {
            $pesan = 'Maaf Produk yang Anda cari tidak tersedia.';
            return view('admin.produk', compact('pesan'));
        }
        return view('admin.produk', compact('products', 'categories', 'id'));
    }
    public function category($id)
    {
        $categories = Category::all();
        $products = product::where('category_id', $id)->get();
        return view('admin.produk', compact('products','categories', 'id'));
    }

    public function destroy(Product $product)
    {
        try {
            if($product->image) {
                Storage::delete($product->image);
            }
            Product::destroy($product->id);
            Alert::success('Berhasil', 'Produk Telah Dihapus!');
            return redirect('produk');
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->errorInfo[1] == 1451) {
                DB::beginTransaction();
                try {
                    // hapus data terkait di table carts
                    Cart::where('product_id', $product->id)->delete();

                    // hapus data terkait di table transaction_details
                    TransactionDetail::where('product_id', $product->id)->delete();

                    // hapus produk
                    Product::destroy($product->id);

                    DB::commit();
                    Alert::success('Berhasil', 'Produk Telah Dihapus!');
                    return redirect('produk');
                } catch(\Exception $ex) {
                    DB::rollback();
                    Alert::error('Error', 'Gagal menghapus produk!');
                    return redirect('produk');
                }
            }
            // else {
            //     Alert::error('Error', 'Gagal menghapus produk!');
            //     return redirect('produk');
            // }
        }
    }
    public function edit($id)
    {
        return view('admin.edit', [
            'categories' => Category::all(),
            'product' => Product::find($id),
            'title' => 'Admin | Hoodie Station'
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:6',
            'price' => 'required',
            'stok' => 'required',
            'category_id' => 'required',
            'desc' => 'required|min:10',
            'image' => 'image|file',
        ],
        [
            'name.required' => 'Nama Harus Diisi',
            'name.min' => 'Nama Minimal 6',
            'price.required' => 'Harga Harus Diisi',
            'stok.required' => 'Stok Harus Diisi',
            'desc.required' => 'Harga Harus Diisi',
            'desc.min' => 'Harga Minimal 10',
            'image.image' => 'Gambar harus berupa gambar',
        ]);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('img');
        }

        Product::where('id', $product->id)
            ->update($validatedData);
        Alert::success('Berhasil', 'Produk Berhasil Diubah!');
        return redirect('produk');
    }
}
