<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Modify users table
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify products table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify customers table
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify purchases table
        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });

        // Modify units table
        Schema::table('units', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->default(1); // Assuming '1' represents 'active'
            $table->foreign('status_id')->references('id')->on('master_status')->onDelete('set null');
        });
    }

    public function down()
    {
        // Rollback changes for users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for customers table
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for purchases table
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        // Rollback changes for units table
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};
