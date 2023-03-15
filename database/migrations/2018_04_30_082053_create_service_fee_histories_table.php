<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceFeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_fee_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('deposite_id')->nullable();
            $table->foreign('deposite_id')->references('id')->on('deposit_history');
            $table->unsignedInteger('withdrawal_id')->nullable();
            $table->foreign('withdrawal_id')->references('id')->on('withdwaral_history');
            $table->enum('reference_type',['DEPOSIT','WITHDRAWAL']);
            $table->float('amount',9,2);
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
        Schema::dropIfExists('service_fee_histories');
    }
}
