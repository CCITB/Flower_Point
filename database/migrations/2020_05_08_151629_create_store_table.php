<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('store', function (Blueprint $table) {
      $table->bigIncrements('st_no');
      $table->string('st_name');
      $table->string('st_tel');
      $table->string('st_address');
      $table->string('st_registeration_num');
      $table->string('st_introduce');
      $table->string('st_date');
      $table->string('st_status')->nullable()->default('사용중'); //or 휴면

      //외래키
      $table->unsignedBigInteger('store_no')->nullable();
      $table->foreign('store_no')->references('st_no')->on('store')->onDelete('cascade')->onUpdate('cascade');

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
    Schema::dropIfExists('store');
  }
}
