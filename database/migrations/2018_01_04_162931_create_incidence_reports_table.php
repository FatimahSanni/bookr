<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidence_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('reporter_id')->unsigned()->nullable();
            $table->boolean('collision');
            $table->boolean('injury');
            $table->string('location');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reporter_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidence_reports');
    }
}
