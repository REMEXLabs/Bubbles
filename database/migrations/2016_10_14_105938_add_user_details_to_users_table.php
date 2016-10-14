<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('skills')->nullable();
            $table->string('location')->nullable();
            $table->boolean('dashboard_tagcloud')->default(1);
            $table->boolean('dashboard_accepted_quests')->default(1);
            $table->boolean('dashboard_created_quests')->default(1);
            $table->boolean('dashboard_created_projects')->default(1);
            $table->string('share_twitter')->nullable();
            $table->string('share_github')->nullable();
            $table->string('share_google')->nullable();
            $table->string('share_stackoverflow')->nullable();
            $table->string('share_linkedin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('skills');
            $table->dropColumn('location');
            $table->dropColumn('dashboard_tagcloud');
            $table->dropColumn('dashboard_accepted_quests');
            $table->dropColumn('dashboard_created_quests');
            $table->dropColumn('dashboard_created_projects');
            $table->dropColumn('share_twitter');
            $table->dropColumn('share_github');
            $table->dropColumn('share_google');
            $table->dropColumn('share_stackoverflow');
            $table->dropColumn('share_linkedin');
        });
    }
}
