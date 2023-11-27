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
        Schema::create('detail_master_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_value_id');
            $table->string('name');
            $table->text('description')->nullable();
            // Add any other fields you need in the detail master values table
            $table->timestamps();

            // Foreign key constraint to link with the master values table
            $table->foreign('master_value_id')->references('id')->on('master_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_master_values');
    }
};
