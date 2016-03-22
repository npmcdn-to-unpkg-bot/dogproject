<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogParentFatherEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_parent_father_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dog_id')->unsigned();
//            $table->foreign('dog_id')->references('id')->on('dog_entities')->onDelete('cascade');
            $table->integer('father_id')->unsigned();
//            $table->foreign('father_id')->references('id')->on('dog_father_entities')->onDelete('cascade');
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
        Schema::drop('dog_parent_father_entities');
    }

}
