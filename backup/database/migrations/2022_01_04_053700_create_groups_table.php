<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('gp_groupname')->unique();
            $table->string('password');
            $table->string('gp_temp_psw'); // Added this field temporarily, will be deleted on production
            $table->unsignedBigInteger('gp_status')->nullable();
            $table->foreign('gp_status')->references('id')->on('group_statuses');
            $table->string('gp_company');
            $table->string('gp_cc')->nullable()->comment('country code');
            $table->string('gp_ac')->nullable()->comment('area code');
            $table->string('gp_wpp_group_id');
            $table->string('gp_country_id')->nullable();
            $table->string('gp_country_name')->nullable();
            $table->string('gp_state');
            $table->string('gp_city');
            $table->string('gp_district');
            $table->string('gp_address');
            $table->string('gp_zip');
            $table->string('gp_legal_name');
            $table->string('gp_legal_id');
            $table->unsignedBigInteger('gp_plan')->nullable();
            $table->foreign('gp_plan')->references('id')->on('group_plans');
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
        Schema::dropIfExists('groups');
    }
}
