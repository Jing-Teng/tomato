<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('path')->default("default");
            $table->integer('length')->default(25);
            $table->integer('minute')->default(25);
            $table->integer('pcs')->default(1);
            $table->integer('short')->default(5);
            $table->integer('long')->default(10);
            $table->boolean('battle')->default(true);
            $table->boolean('ring')->default(true);
            $table->boolean('vibration')->default(true);
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
        Schema::dropIfExists('settings');
    }
}
