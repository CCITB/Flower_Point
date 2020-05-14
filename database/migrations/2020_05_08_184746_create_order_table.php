<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('order', function (Blueprint $table) {
      $table->bigIncrements('o_no');
      $table->string('o_status')->nullable();

      //외래키
      $table->unsignedBigInteger('payment_no')->nullable();
      $table->foreign('payment_no')->references('pm_no')->on('payment')->onDelete('cascade')->onUpdate('cascade');
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
    Schema::dropIfExists('order');
  }
}
