<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('screen_id');
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
            $table->integer('column');
            $table->string('row', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('sheets');
    }
}
