<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('basket', function (Blueprint $table) {
      $table->bigIncrements('b_no');
      $table->integer('b_count');
      $table->string('b_option')->nullable();

      //외래키
      $table->unsignedBigInteger('customer_no')->nullable();
      $table->foreign('customer_no')->references('c_no')->on('customer')->onDelete('cascade')->onUpdate('cascade');
      $table->unsignedBigInteger('product_no')->nullable();
      $table->foreign('product_no')->references('p_no')->on('product')->onDelete('cascade')->onUpdate('cascade');

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
    Schema::dropIfExists('basket');
  }
}
