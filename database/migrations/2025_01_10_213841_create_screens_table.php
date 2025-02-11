<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('スクリーン名');
            $table->timestamps();
        });

        // Schema::table('schedules', function (Blueprint $table) {
        //     $table->unsignedBigInteger('screen_id')->after('movie_id');
        //     $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        // });

        // Schema::table('sheets', function (Blueprint $table) {
        //     $table->unsignedBigInteger('screen_id');
        //     $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        // });

        // Schema::table('reservations', function (Blueprint $table) {
        //     $table->unsignedBigInteger('screen_id')->after('sheet_id');
        //     $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['screen_id']);
            $table->dropColumn('screen_id');
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['screen_id']);
            $table->dropColumn('screen_id');
        });

        Schema::dropIfExists('screens');
    }
}
