<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffPickDogEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_pick_dog_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dog_id')->unsigned();
//            $table->foreign('dog_id')->references('id')->on('dog_entities');
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
        Schema::drop('staff_pick_dog_entities');
    }

}
