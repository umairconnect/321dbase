<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('usr_mobile');
            $table->string('usr_fullname');
            $table->string('usr_firstname')->nullable();
            $table->string('password')->nullable();
            $table->string('usr_temp_psw')->nullable(); // Added this field temporarily, will be deleted on production
            $table->string('usr_token')->nullable();
            $table->date('usr_dob')->nullable();
            $table->date('usr_sign-up')->nullable();
            $table->date('usr_last_login')->nullable();
            $table->string('usr_picture')->nullable();
            $table->boolean('usr_opt-out')->default(false);
            $table->unsignedBigInteger('usr_group_id');
            $table->foreign('usr_group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->unsignedBigInteger('usr_operator_id')->nullable();
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
