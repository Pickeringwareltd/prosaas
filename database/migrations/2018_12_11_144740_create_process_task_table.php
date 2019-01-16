<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_task', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('process_id');
            $table->unsignedInteger('task_id');
            $table->integer('index');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onCascade('delete');
            $table->foreign('process_id')->references('id')->on('processes')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_task');
    }
}
