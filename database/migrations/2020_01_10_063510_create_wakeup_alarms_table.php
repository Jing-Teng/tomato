<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWakeupAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wakeup_alarms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_id')->index();
            //$table->string('cycle');
            //$table->boolean('open');
            $table->string('name');
            $table->time('alarm_time');            
            //$table->date('create_date')->default(date("Y-m-d"));
            $table->time('wakeup_time')->nullable();
            $table->integer('lazy_times')->nullable();
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
        Schema::dropIfExists('wakeup_alarms');
    }
}
