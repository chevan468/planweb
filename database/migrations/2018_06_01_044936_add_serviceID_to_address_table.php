<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceIDToAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
          
          $table->integer('province_id')->unsigned();


          //--------------------
          //$table->primary('id');
          $table->foreign('province_id')->references('id')->on('provinces');
          
          $table->integer('district_id')->unsigned();


          //--------------------
          //$table->primary('id');
          $table->foreign('district_id')->references('id')->on('districts');
          $table->string('fullAddress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
