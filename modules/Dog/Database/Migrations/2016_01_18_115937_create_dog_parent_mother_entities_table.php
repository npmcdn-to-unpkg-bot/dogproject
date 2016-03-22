<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogParentMotherEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_parent_mother_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dog_id')->unsigned();
//            $table->foreign('dog_id')->references('id')->on('dog_entities')->onDelete('cascade');
            $table->integer('mother_id')->unsigned();
//            $table->foreign('mother_id')->references('id')->on('dog_mother_entities')->onDelete('cascade');
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
        Schema::drop('dog_parent_mother_entities');
    }

}
