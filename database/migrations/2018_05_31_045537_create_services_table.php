<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        
         Schema::create('services', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name',100);
          $table->integer('user_id')->unsigned();


          //--------------------
          //$table->primary('id');
          $table->foreign('user_id')->references('id')->on('users');
          
          $table->integer('category_id')->unsigned();


          //--------------------
          //$table->primary('id');
          $table->foreign('category_id')->references('id')->on('categories');
        
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }
}
