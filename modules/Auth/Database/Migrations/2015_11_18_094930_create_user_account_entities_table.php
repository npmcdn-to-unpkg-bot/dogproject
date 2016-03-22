<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('contact_number',50);
            $table->enum('role',array('1', '2','3'));
            $table->enum('status',array('pending', 'active'));
            $table->string('remember_token', 100);
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
        Schema::drop('users');
    }

}
