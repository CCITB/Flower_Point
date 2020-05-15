<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('review', function (Blueprint $table) {
      $table->bigIncrements('r_no');
      $table->string('r_title');
      $table->string('r_contents');
      $table->string('r_status')->nullable()->default('등록'); //or삭제

      //외래키
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
    Schema::dropIfExists('review');
  }
}
