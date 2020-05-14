<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('payment', function (Blueprint $table) {
      $table->bigIncrements('pm_no');
      $table->integer('pm_count');
      $table->string('pm_pay');
      $table->date('pm_date');
      $table->string('pm_status')->nullable();

      //외래키
      $table->unsignedBigInteger('customer_no')->nullable();
      $table->foreign('customer_no')->references('c_no')->on('customer')->onDelete('cascade')->onUpdate('cascade');
      $table->unsignedBigInteger('delivery_no')->nullable()->nullable();
      $table->foreign('delivery_no')->references('d_no')->on('delivery')->onDelete('cascade')->onUpdate('cascade');
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
    Schema::dropIfExists('payment');
  }
}
