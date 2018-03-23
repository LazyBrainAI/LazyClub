<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();

            $table->string('photo_link')->nullable();
            $table->string('position')->nullable();
            $table->string('sector')->nullable();
            $table->text('bio')->nullable();
            $table->date('join_date');
            $table->string('status');
            $table->integer('strength')->nullable();
            $table->string('phone_num')->nullable();

            $table->integer('SystemRole_id')->unsigned();
            $table->foreign('SystemRole_id')->references('id')->on('system_roles');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
