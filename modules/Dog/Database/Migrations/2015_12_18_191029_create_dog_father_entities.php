<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogFatherEntities extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_father_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('breed_id')->unsigned();
//            $table->foreign('breed_id')->references('id')->on('dog_breed_entities');
            $table->date('birth_date');
            $table->string('image');
            $table->enum('temperament', array(1,2,3));
            $table->enum('energy', array(1,2,3));
            $table->enum('intelligence', array(1,2,3));
            $table->enum('maintenance', array(1,2,3));
            $table->integer('seller_id')->unsigned();
//            $table->foreign('seller_id')->references('id')->on('user_account_entities');
            $table->softDeletes();
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
        Schema::drop('dog_father_entities');
    }

}
