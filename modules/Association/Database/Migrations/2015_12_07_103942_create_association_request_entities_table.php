<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationRequestEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_request_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('contact_number');
            $table->string('website');
            $table->integer('suburb_id')->unsigned();
//            $table->foreign('suburb_id')->references('id')->on('location_suburb_entities');
            $table->integer('state_id')->unsigned();
//            $table->foreign('state_id')->references('id')->on('location_state_entities');
            $table->enum('status',array("pending","finished","rejected","banned"));
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
        Schema::drop('association_request_entities');
    }

}
