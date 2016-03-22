<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationMemberInviteEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_member_invite_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('association_id')->unsigned();  //id from user_account entities
//            $table->foreign('association_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->integer('seller_id')->unsigned();    //id from user_account_entities
//            $table->foreign('seller_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->string('member_email');
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->integer('number');
            $table->enum('status',array('pending','active'));
            $table->enum('requested',array('association','seller'));
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
        Schema::drop('association_member_invite_entities');
    }

}
