<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImageTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('product_image', function (Blueprint $table) {
      $table->bigIncrements('i_no');
      $table->string('i_filename');
      $table->date('i_date');
      $table->string('i_status')->nullable()->default('등록'); //or 삭제


      //외래키
      $table->unsignedBigInteger('product_no')->nullable()->onDelete('cascade')->onUpdate('cascade');
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
    Schema::dropIfExists('product_image');
  }
}
