<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'produk_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemproduk = Produk::findOrFail($request->produk_id);
        // cek dulu apakah sudah ada shopping Keranjang untuk user yang sedang login
        $Keranjang = Keranjang::where('user_id', $itemuser->id)
                    ->where('status_Keranjang', 'Keranjang')
                    ->first();
        
        if ($Keranjang) {
            $itemKeranjang = $Keranjang;
        } else {
            $no_invoice = Keranjang::where('user_id', $itemuser->id)->count();
            //nyari jumlah Keranjang berdasarkan user yang sedang login untuk dibuat no invoice
            $inputanKeranjang['user_id'] = $itemuser->id;
            $inputanKeranjang['no_invoice'] = 'INV '.str_pad(($no_invoice + 1),'3', '0', STR_PAD_LEFT);
            $inputanKeranjang['status_Keranjang'] = 'Keranjang';
            $inputanKeranjang['status_pembayaran'] = 'belum';
            $inputanKeranjang['status_pengiriman'] = 'belum';
            $itemKeranjang = Keranjang::create($inputanKeranjang);
        }
        // cek dulu apakah sudah ada produk di shopping Keranjang
        $cekdetail = KeranjangDetail::where('Keranjang_id', $itemKeranjang->id)
                                ->where('produk_id', $itemproduk->id)
                                ->first();
        $qty = 1;// diisi 1, karena kita set ordernya 1
        $harga = $itemproduk->harga;//ambil harga produk
        $diskon = $itemproduk->promo != null ? $itemproduk->promo->diskon_nominal: 0;
        $subtotal = ($qty * $harga) - $diskon;
        // diskon diambil kalo produk itu ada promo, cek materi sebelumnya
        if ($cekdetail) {
            // update detail di table Keranjang_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga, $diskon);
            // update subtotal dan total di table Keranjang
            $cekdetail->Keranjang->updatetotal($cekdetail->Keranjang, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['Keranjang_id'] = $itemKeranjang->id;
            $inputan['produk_id'] = $itemproduk->id;
            $inputan['qty'] = $qty;
            $inputan['harga'] = $harga;
            $inputan['diskon'] = $diskon;
            $inputan['subtotal'] = ($harga * $qty) - $diskon;
            $itemdetail = KeranjangDetail::create($inputan);
            // update subtotal dan total di table Keranjang
            $itemdetail->Keranjang->updatetotal($itemdetail->Keranjang, $subtotal);
        }
        return redirect()->route('Keranjang.index')->with('success', 'Produk berhasil ditambahkan ke Keranjang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeranjangDetail  $KeranjangDetail
     * @return \Illuminate\Http\Response
     */
    public function show(KeranjangDetail $KeranjangDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeranjangDetail  $KeranjangDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(KeranjangDetail $KeranjangDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeranjangDetail  $KeranjangDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeranjangDetail $KeranjangDetail)
    {
        $itemdetail = KeranjangDetail::findOrFail($id);
        $param = $request->param;
        
        if ($param == 'tambah') {
            // update detail Keranjang
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga, $itemdetail->diskon);
            // update total Keranjang
            $itemdetail->Keranjang->updatetotal($itemdetail->Keranjang, ($itemdetail->harga - $itemdetail->diskon));
            return back()->with('success', 'Item berhasil diupdate');
        }
        if ($param == 'kurang') {
            // update detail Keranjang
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-'.$qty, $itemdetail->harga, $itemdetail->diskon);
            // update total Keranjang
            $itemdetail->Keranjang->updatetotal($itemdetail->Keranjang, '-'.($itemdetail->harga - $itemdetail->diskon));
            return back()->with('success', 'Item berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeranjangDetail  $KeranjangDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeranjangDetail $KeranjangDetail)
    {
        $itemdetail = KeranjangDetail::findOrFail($id);
        // update total Keranjang dulu
        $itemdetail->Keranjang->updatetotal($itemdetail->Keranjang, '-'.$itemdetail->subtotal);
        if ($itemdetail->delete()) {
            return back()->with('success', 'Item berhasil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }
    }
}
