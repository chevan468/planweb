<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
     public function up()
    {
        Schema::create('districts', function (Blueprint $table) {

          $table->increments('id');
          $table->string('name',100);
          $table->integer('province_id')->unsigned();


          //--------------------
          //$table->primary('id');
          $table->foreign('province_id')->references('id')->on('provinces');

      });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

          Schema::drop('districts');

    }
}
