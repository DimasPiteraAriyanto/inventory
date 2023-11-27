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
        Schema::create('item_products', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->string('detail');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('production_id');

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('production_id')->references('id')->on('productions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_products');
    }
};
