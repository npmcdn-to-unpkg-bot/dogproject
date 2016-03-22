<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffPickAssociationEntitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_pick_association_entities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('association_id')->unsigned();
//            $table->foreign('association_id')->references('id')->on('association_entities');
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
        Schema::drop('staff_pick_association_entities');
    }

}
