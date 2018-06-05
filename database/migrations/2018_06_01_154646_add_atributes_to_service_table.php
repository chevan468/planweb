<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtributesToServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
          
            $table->string('description');
            $table->double('price');
          
          $table->integer('pricePer_id')->unsigned();
          //--------------------
          //$table->primary('id');
          $table->foreign('pricePer_id')->references('id')->on('price_pers');

            $table->integer('legalNumber');
            $table->integer('contactNumber');;
            $table->string('contactEmail');
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
