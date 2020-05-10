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
