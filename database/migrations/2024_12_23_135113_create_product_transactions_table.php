<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('booking_trx_id'); // Kolom untuk menyimpan ID Transaksi
            $table->string('city');
            $table->string('post_code');
            $table->string('proof'); // Kolom untuk menyimpan bukti transaksi
            $table->string('product_size');

            $table->text('address');

            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('sub_total_amount'); // Harga sebelum diskon
            $table->unsignedBigInteger('grand_total_amount'); // Harga setelah diskon
            $table->unsignedBigInteger('discount_amount'); // Untuk menyimpan jumlah diskon yg diberikan

            $table->boolean('is_paid'); // Kolom untuk menandai product sudah dibayar atau belum

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('promo_code_id')->nullable()->constrained()->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transactions');
    }
};
