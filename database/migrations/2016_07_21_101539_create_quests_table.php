<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')->references('id')->on('users');
            // https://cloud.githubusercontent.com/assets/2623954/9098640/f15e22b4-3b7f-11e5-9496-12b6d811f0ea.jpg
            $table->string('repository')->nullable();
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->enum('language', array_keys(Quest::getLanguages()))->nullable();
            $table->enum('difficulty', ['easy', 'normal', 'hard'])->default('normal')->nullable();
            $table->enum('state', ['open', 'wip', 'check', 'resolved'])->default('open');
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
        Schema::drop('quests');
    }
}
