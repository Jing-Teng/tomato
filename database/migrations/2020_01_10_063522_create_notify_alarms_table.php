<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_alarms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_id')->index();
            //$table->boolean('open');
            //$table->string('cycle');
            $table->string('name');
            $table->time('alarm_time');
            //$table->date('create_date')->default(date("Y-m-d"));
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
        Schema::dropIfExists('notify_alarms');
    }
}
