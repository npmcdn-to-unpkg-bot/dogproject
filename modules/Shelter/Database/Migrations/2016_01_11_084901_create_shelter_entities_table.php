<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelterEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();   //id from user_account_entities
//            $table->foreign('user_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->string('name');
            $table->string('web_address');
            $table->string('address');
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->text('about');
            $table->string('avatar');
            $table->string('advert_photo');
            $table->string('slug');
            $table->boolean('newsletter');
            $table->boolean('terms');
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
        Schema::drop('shelter_entities');
    }

}
