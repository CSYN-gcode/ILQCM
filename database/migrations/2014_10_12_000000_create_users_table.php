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
            $table->id('id');
            $table->string('name');
            $table->string('username', 30)->unique();
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->tinyInteger('user_level')->comment = '1=Admin; 2=Encoder; 3=Branch Manager; 4=Branch Staff';
            $table->tinyInteger('status')->default(1)->comment = '1=active; 2=deactivated; 3=disabled';
            $table->integer('attempt')->default(0);
            $table->tinyInteger('logdel')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
