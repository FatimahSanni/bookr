<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license_number');
            $table->string('chassis_number');
            $table->integer('year_of_manufacture')->unsigned();
            $table->integer('vehicle_model_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('driver_id')->references('id')->on('users')->onUpdate('cascade')->onCascade('cascade');
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->onUpdate('cascade')->onCascade('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
