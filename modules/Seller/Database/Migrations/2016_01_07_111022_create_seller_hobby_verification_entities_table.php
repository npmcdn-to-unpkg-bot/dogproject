<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerHobbyVerificationEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_hobby_verification_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('seller_id')->unsigned(); //id iz user_account_entities
            $table->foreign('seller_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->boolean('question1')->nullable();
            $table->boolean('question2')->nullable();
            $table->boolean('question3')->nullable();
            $table->boolean('question4')->nullable();
            $table->boolean('question5')->nullable();
            $table->boolean('question6')->nullable();
            $table->boolean('question7')->nullable();
            $table->boolean('question8')->nullable();
            $table->boolean('question9')->nullable();
            $table->boolean('question10')->nullable();
            $table->enum('status',array('pending','verified','rejected'));
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
        Schema::drop('seller_hobby_verification_entities');
    }

}
