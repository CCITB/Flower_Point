<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('customer', function (Blueprint $table) {
      $table->bigIncrements('c_no');
      $table->string('c_id');
      $table->string('c_password');
      $table->string('c_name');
      $table->string('c_phonenum');
      $table->string('c_address');
      $table->string('c_email');
      $table->string('c_point');
      $table->string('c_state')->nullable()->default('사용중'); //or 휴면
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
    Schema::dropIfExists('customer');
  }
}
