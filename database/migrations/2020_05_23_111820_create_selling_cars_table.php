<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

            $table->string('make_year');
            $table->float('kms_run');
            $table->integer('engine_cc');
            $table->string('color');
            $table->float('asking_price');
            $table->unsignedBigInteger('seller_id')->unsigned()->nullable();;
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->string('car_status');
            $table->string('additional_details');
            $table->string('post_date');

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
        Schema::dropIfExists('selling_cars');
    }
}
