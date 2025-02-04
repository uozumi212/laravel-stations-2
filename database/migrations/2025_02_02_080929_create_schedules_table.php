<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id()->comments('スケジュールID');
            $table->unsignedBigInteger('movie_id')->comments('列');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // $table->unsignedBigInteger('sheet_id');
            // $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
            $table->datetime('start_time')->comments('上映開始時間');
            $table->datetime('end_time')->comments('上映終了時間');
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
        Schema::dropIfExists('schedules');
    }
}
