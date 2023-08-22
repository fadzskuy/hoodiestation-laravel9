<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CreateController extends Controller
{
    public function index()
    {
        return view('admin.create',[
            'categories' => Category::all(),
            'title' => 'Admin | Hoodie Station',
        ]);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        // return $request->file('image')->store('img');
        $validatedData = $request->validate([
            'name' => 'required|min:6|unique:products',
            'price' => ['required', 'numeric', 'max:1000000'],
            'stok' => 'required',
            'category_id' => 'required',
            'desc' => 'required|min:10',
            'image' => 'required|image|file'
        ],
    [
        'name.required' => 'Nama Harus Diisi',
        'name.min' => 'Nama Minimal 6',
        'name.unique' => 'Produk sudah ada',
        'price.required' => 'Harga Harus Diisi',
        'price.numeric' => 'Harga harus berupa angka',
        'price.max' => 'Harga tidak boleh lebih dari 1 juta',
        'stok.required' => 'Stok Harus Diisi',
        'desc.required' => 'Deskripsi Harus Diisi',
        'desc.min' => 'Deskripsi Minimal 10',
        'image.image' => 'Gambar harus berupa gambar',
        'image.required' => 'Gambar Harus Diisi',
    ]);
    if($request->file('image')) {
        $validatedData['image'] = $request->file('image')->store('img');
    }
        Product::create($validatedData);
        Alert::success('Berhasil', 'Produk Telah Ditambahkan!');
        return redirect('produk');
    }
}
