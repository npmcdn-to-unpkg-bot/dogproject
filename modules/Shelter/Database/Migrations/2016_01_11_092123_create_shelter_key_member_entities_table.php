<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelterKeyMemberEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_key_member_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('shelter_id')->unsigned();  //id from user_account_entities
//            $table->foreign('shelter_id')->references('id')->on('user_account_entities')->onDelete('cascade');
            $table->enum('type',array(0,1,2));
            $table->string('name');
            $table->string('email');
            $table->integer('user_id')->unsigned();  //if member has account on petagree, if not remains empty
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
        Schema::drop('shelter_key_members_entities');
    }

}
