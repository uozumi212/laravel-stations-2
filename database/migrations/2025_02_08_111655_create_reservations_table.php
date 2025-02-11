<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id()->comment('予約ID');
            $table->date('date')->comment('上映日');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('sheet_id');
            $table->unsignedBigInteger('screen_id');
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
            $table->string('email', 255)->comment('予約者のメールアドレス');
            $table->string('name', 255)->comment('予約者の名前');
            $table->boolean('is_canceled')->default(false)->comment('予約キャンセル済み');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('sheet_id')->references('id')->on('sheets');
            // $table->unique(['schedule_id', 'sheet_id', 'screen_id'], 'unique_reservation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
