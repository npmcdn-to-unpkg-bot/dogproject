<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationKeyMembersEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_key_members_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('association_id')->unsigned();  //id from user_account_entities
//            $table->foreign('association_id')->references('id')->on('user_account_entities')->onDelete('cascade');
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
        Schema::drop('association_key_members_entities');
    }

}
