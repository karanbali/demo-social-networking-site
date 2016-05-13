<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userProfiles', function (Blueprint $table) {
            $table->integer('user_id')->unique();
            $table->string('name',60);
            $table->string('pic');
            $table->date('dob');
            $table->char('sex',1);
            $table->string('about_me',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('userProfiles');
    }
}
