<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitCreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('value', 4, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_id')->unsigned()->nullable(false);
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('products_vouchers', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->nullable(false);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('voucher_id')->unsigned()->nullable(false);
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');
            $table->primary(['product_id', 'voucher_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_vouchers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('discounts');
    }
}
