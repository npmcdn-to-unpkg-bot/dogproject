<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationMemberEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_member_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();  //id from user_account_entities
//            $table->foreign('seller_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->integer('association_id')->unsigned();  //id from user_account_entities
//            $table->foreign('association_id')->references('id')->on('user_account_entities')->onDelete('cascade');
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
        Schema::drop('association_member_entities');
    }




}
