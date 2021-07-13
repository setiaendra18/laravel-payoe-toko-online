<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'no_invoice',
        'status_cart',
        'status_pembayaran',
        'status_pengiriman',
        'no_resi',
        'ekspedisi',
        'subtotal',
        'ongkir',
        'diskon',
        'total',
    ];

    public function user() {
        return $this->belongsTo('App\User','id');
    }

    public function detail() {
        return $this->hasMany('App\KeranjangDetail', 'id');
    }

    public function updatetotal($itemcart, $subtotal) {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }
}
