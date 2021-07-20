<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        
        return view('pages.admin.produk.index');
        
    }
    public function create()
    {
        return view('pages.admin.produk.create');
    }
}
