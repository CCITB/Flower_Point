<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('product', function (Blueprint $table) {
      $table->bigIncrements('p_no');
      $table->string('p_name');
      $table->string('p_title');
      $table->string('p_contents');
      $table->integer('p_price');
      $table->string('p_status')->nullable()->default('등록'); //or 삭제

      //외래키
      $table->unsignedBigInteger('store_no')->nullable();
      $table->foreign('store_no')->references('st_no')->on('store')->onDelete('cascade')->onUpdate('cascade');
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
    Schema::dropIfExists('product');
  }
}
