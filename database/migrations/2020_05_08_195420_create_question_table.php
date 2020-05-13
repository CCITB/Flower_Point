<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('question', function (Blueprint $table) {
      $table->bigIncrements('q_no');
      // $table->forein('customer_no')->references('c_no')->on('customer');
      // $table->forein('product_no')->references('p_no')->on('product');
      $table->string('q_title');
      $table->string('q_contents');
      $table->date('q_date');
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
    Schema::dropIfExists('question');
  }
}
