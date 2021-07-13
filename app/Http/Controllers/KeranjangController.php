<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();//ambil data user
        $itemcart = Keranjang::where('user_id', $itemuser->id)
                        ->where('status_cart', 'cart')
                        ->first();
        $data = array('title' => 'Shopping Cart',
                    'itemcart' => $itemcart);
        return view('cart.index', $data)->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(keranjang $keranjang)
    {
        //
    }
}
