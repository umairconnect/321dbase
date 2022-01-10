<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWifisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifis', function (Blueprint $table) {
            $table->id();
            $table->string('mac_wan');
            $table->string('mac_lan');
            $table->string('bssid');
            $table->unsignedInteger('nasid');
            $table->string('channel');
            $table->string('city');
            $table->string('router_os')->nullable();
            $table->string('firmware')->nullable();
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
        Schema::dropIfExists('wifis');
    }
}
