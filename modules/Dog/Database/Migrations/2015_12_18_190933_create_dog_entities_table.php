<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('breed_id')->unsigned();
            $table->foreign('breed_id')->references('id')->on('dog_breed_entities');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->integer('suburb_id')->unsigned();
            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->date('birth_date');
            $table->enum('type_of_listing',array("single","mature","litter","rescue"));
            $table->enum('sex',array("M","F",""))->default("");
            $table->integer('male_qty');
            $table->integer('female_qty');
            $table->integer('cost');
            $table->text('about');
            $table->string('name');
            $table->boolean('vaccination')->nullable();
            $table->boolean('vet_checked')->nullable();
            $table->boolean('desexed')->nullable();
            $table->boolean('de_warmed')->nullable();
            $table->boolean('micro_chipped')->nullable();
            $table->boolean('registration_papers')->nullable();
            $table->boolean('family_dog')->nullable();
            $table->boolean('indoor_dog')->nullable();
            $table->boolean('energetic')->nullable();
            $table->boolean('friendly')->nullable();
            $table->boolean('outdoor_dog')->nullable();
            $table->boolean('relaxed')->nullable();
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('user_account_entities');
            $table->integer('mother_id')->unsigned();
            $table->foreign('mother_id')->references('id')->on('dog_mother_entities');
            $table->integer('father_id')->unsigned();
            $table->foreign('father_id')->references('id')->on('dog_father_entities');
            $table->enum('listing_status',array('banned','listed'))->default("listed");
            $table->boolean('sold')->default(0);
            $table->integer('male_sold')->unsigned();
            $table->integer('female_sold')->unsigned();
            $table->string('slug');
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
        Schema::drop('dog_entities');
    }

}
