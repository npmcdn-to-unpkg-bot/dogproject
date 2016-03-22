<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerAccountEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_account_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();   //id from user_account_entities
//            $table->foreign('user_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->enum('type',array('hobby','verified','single'));
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->string('address');
            $table->string('photo');
            $table->string('language');
            $table->string('find_out');
            $table->string('about');
            $table->boolean('newsletter');
            $table->boolean('terms');
            $table->boolean('smartphone');
            $table->boolean('verified',0);
            $table->boolean('suspicious',0);
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
        Schema::drop('seller_account_entities');
    }

}
