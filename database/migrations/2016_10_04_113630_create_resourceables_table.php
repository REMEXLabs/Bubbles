<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resourceables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned();
            // $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('resourceable_id')->unsigned();
            $table->string('resourceable_type');
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
        Schema::drop('resourceables');
    }
}
