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
            $table->id()->comment('スケジュールID');
            $table->unsignedBigInteger('movie_id')->comment('列');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->unsignedBigInteger('screen_id')->comment('スクリーンID');  // ★ nullable() を削除
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
            $table->datetime('start_time')->comment('上映開始時間');
            $table->datetime('end_time')->comment('上映終了時間');
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
