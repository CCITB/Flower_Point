<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllForeinkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('seller', function(Blueprint $table)
      {
        $table->unsignedBigInteger('store_no')->nullable();
        $table->foreign('store_no')->references('st_no')->on('store')->after('s_no');

        $table->unsignedBigInteger('payment_no')->nullable();
        $table->foreign('payment_no')->references('pm_no')->on('payment')->after('s_no');
      });
      Schema::table('order', function(Blueprint $table)
      {
        $table->unsignedBigInteger('payment_no')->nullable();
        $table->foreign('payment_no')->references('pm_no')->on('payment');
      });
      Schema::table('payment', function(Blueprint $table)
      {
        $table->unsignedBigInteger('customer_no')->nullable();
        $table->foreign('customer_no')->references('c_no')->on('customer');
        $table->unsignedBigInteger('delivery_no')->nullable()->nullable();
        $table->foreign('delivery_no')->references('d_no')->on('delivery');
        $table->unsignedBigInteger('product_no')->nullable();
        $table->foreign('product_no')->references('p_no')->on('product');
      });
      Schema::table('basket', function(Blueprint $table)
      {
        $table->unsignedBigInteger('customer_no')->nullable();
        $table->foreign('customer_no')->references('c_no')->on('customer');
        $table->unsignedBigInteger('product_no')->nullable();
        $table->foreign('product_no')->references('p_no')->on('product');
      });
      Schema::table('product', function(Blueprint $table)
      {
        $table->unsignedBigInteger('store_no')->nullable();
        $table->foreign('store_no')->references('st_no')->on('store');
      });
      Schema::table('review', function(Blueprint $table)
      {
        $table->unsignedBigInteger('product_no')->nullable();
        $table->foreign('product_no')->references('p_no')->on('product');
      });
      Schema::table('question', function(Blueprint $table)
      {
        $table->unsignedBigInteger('customer_no')->nullable();
        $table->foreign('customer_no')->references('c_no')->on('customer');
        $table->unsignedBigInteger('product_no')->nullable();
        $table->foreign('product_no')->references('p_no')->on('product');
      });
      Schema::table('product_image', function(Blueprint $table)
      {
        $table->unsignedBigInteger('product_no')->nullable();
        $table->foreign('product_no')->references('p_no')->on('product');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('seller', function(Blueprint $table){});
      Schema::table('order', function(Blueprint $table){});
      Schema::table('payment', function(Blueprint $table){});
      Schema::table('basket', function(Blueprint $table){});
      Schema::table('product', function(Blueprint $table){});
      Schema::table('review', function(Blueprint $table){});
      Schema::table('question', function(Blueprint $table){});
      Schema::table('product_image', function(Blueprint $table){});
    }
}
