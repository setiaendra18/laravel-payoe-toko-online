<?php

namespace App\Http\Controllers;
use App\Models\Home;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->paginate(5);
        return view('homepage', compact('produk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }
}
