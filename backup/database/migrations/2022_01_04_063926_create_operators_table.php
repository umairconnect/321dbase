<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('opr_name');
            $table->string('opr_mobile');
            $table->string('password');
            $table->string('opr_temp_psw'); // Added this field temporarily, will be deleted on production
            $table->unsignedBigInteger('opr_role_id')->nullable();
            $table->foreign('opr_role_id')->references('id')->on('operator_roles');
            $table->unsignedBigInteger('opr_group_id');
            $table->foreign('opr_group_id')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('operators');
    }
}
