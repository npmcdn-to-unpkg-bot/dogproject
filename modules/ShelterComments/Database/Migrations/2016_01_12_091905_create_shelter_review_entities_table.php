<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelterReviewEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_review_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('shelter_id')->unsigned();  //id from user_account_entities
//            $table->foreign('shelter_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->integer('rating1');
            $table->integer('rating2');
            $table->integer('rating3');
            $table->integer('rating4');
            $table->integer('rating5');
            $table->string('name');
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->text('about');
            $table->string('contact_number');
            $table->boolean('approved')->default(0);
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
        Schema::drop('shelter_review_entities');
    }

}
