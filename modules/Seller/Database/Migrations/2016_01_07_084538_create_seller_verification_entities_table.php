<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerVerificationEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_verification_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('seller_id')->unsigned(); //id iz user_account_entities
//            $table->foreign('seller_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->enum('type',array('1','2'));
            $table->string('number');
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
        Schema::drop('seller_verification_entities');
    }

}
