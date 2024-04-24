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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('sale_date');
            $table->decimal('price_amount',10,2);
            $table->bigInteger('pelanggan_id');
            $table->bigInteger('user_id');
            $table->decimal('total_price', 10,2);
            $table->decimal('return', 10,2);
            $table->decimal('payment', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};