<!-- [eojisu] -->
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('seller', function (Blueprint $table) {
      $table->bigIncrements('s_no');
      $table->string('s_id');
      $table->string('s_password');
      $table->string('s_name');
      $table->string('s_phonenum');
      $table->string('s_email');
      $table->string('s_state')->nullable()->default('사용중'); //or 휴면

      // 외래키
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
    Schema::dropIfExists('seller');
  }
}
