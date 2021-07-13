<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('no_invoice');
            $table->string('status_cart');// ada 2 yaitu cart, checkout
            $table->string('status_pembayaran');// ada 2 sudah dan belum
            $table->string('status_pengiriman');// ada 2 yaitu belum dan sudah
            $table->string('no_resi')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->double('subtotal', 12, 2)->default(0);
            $table->double('ongkir', 12, 2)->default(0);
            $table->double('diskon', 12, 2)->default(0);
            $table->double('total', 12, 2)->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjangs');
    }
}
