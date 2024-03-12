<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            //
            $table->integer('published_year')->after('image_url');
            $table->boolean('is_showing')->after('published_year');
            $table->text('description')->after('is_showing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            //
            $table->dropColumn('published_year');
            $table->dropColumn('is_showing');
            $table->dropColumn('description');
        });
    }
}
