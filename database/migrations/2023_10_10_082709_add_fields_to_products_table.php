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
        Schema::table('products', function (Blueprint $table) {
            // Add brand field referencing detail_master_value
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('detail_master_values');

            // Add other fields referencing detail_master_values
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->foreign('grade_id')->references('id')->on('detail_master_values');

            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('detail_master_values');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('detail_master_values');

            $table->unsignedBigInteger('item_type_id')->nullable();
            $table->foreign('item_type_id')->references('id')->on('detail_master_values');

            $table->unsignedBigInteger('made_in_id')->nullable();
            $table->foreign('made_in_id')->references('id')->on('detail_master_values');

            $table->string('min_stock')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['grade_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['item_type_id']);
            $table->dropForeign(['made_in_id']);

            $table->dropColumn(['brand_id', 'grade_id', 'group_id', 'type_id', 'item_type_id', 'made_in_id']);
        });
    }
};
