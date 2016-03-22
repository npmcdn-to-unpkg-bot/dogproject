<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerEnquireEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_enquiry_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('seller_id')->unsigned(); //id from user_account_entities
//            $table->foreign('seller_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->integer('dog_id'); //foreign key
//            $table->foreign('dog_id')->references('id')->on('dog_entities')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('contact_number');
            $table->text('enquiry');
            $table->string('review_token');
            $table->boolean('reviewed')->default(0);
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
        Schema::drop('seller_enquiry_entities');
    }

}
