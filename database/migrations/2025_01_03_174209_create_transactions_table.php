<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned(); // ID Order yang terkait dengan transaksi
            $table->string('user_name'); // Nama user
            $table->string('user_email'); // Email user
            $table->string('user_phone'); // Nomor HP user
            $table->text('user_address'); // Alamat user
            $table->decimal('amount', 10, 2); // Jumlah yang dibayar
            $table->string('payment_method'); // Metode pembayaran (misalnya: credit card, bank transfer, dll)
            $table->string('status'); // Status transaksi (misalnya: pending, success, failed)
            $table->timestamp('payment_time'); // Waktu pembayaran
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
