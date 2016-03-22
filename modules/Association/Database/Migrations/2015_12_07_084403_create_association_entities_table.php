<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();  //id from user_account_entities
//            $table->foreign('user_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->string('name');
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->string('avatar');  //path do trenutnog avatar
            $table->integer('breed')->unsigned();;
//            $table->foreign('breed')->references('id')->on('dog_breed_entities');
            $table->string('about');
            $table->string('banner_image');  //path do trenutnog bannera
            $table->string('website');  //path do trenutnog bannera
            $table->string('slug')->unique();
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
        Schema::drop('association_entities');
    }

}
