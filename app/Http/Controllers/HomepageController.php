<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        return view('home.homepage',
        [
            'title' => 'Hoodie Station'
        ]);
    }
}
