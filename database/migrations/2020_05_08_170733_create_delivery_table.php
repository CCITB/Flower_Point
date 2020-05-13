<!-- [eojisu] -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('delivery', function (Blueprint $table) {
      $table->bigIncrements('d_no');
      $table->string('d_invoice_num');
      $table->string('d_name');
      $table->string('d_address');
      $table->string('d_status')->nullable()->default('결제완료');//or 배송중
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
    Schema::dropIfExists('delivery');
  }
}
