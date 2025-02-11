<?php

namespace Database\Seeders;

// use App\Practice;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use App\Models\Screen;
use Illuminate\Database\Seeder;
use Database\Seeders\SheetTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    Practice::factory(10)->create();
        $genres = Genre::factory(3)->create();
        // Genre::factory(3)->create();
        // Movie::factory(3)->create(['genre_id' => $genres->pluck('id')->random()]);
        foreach (Movie::all() as $movie) {
            $movie->genre_id = $genres->pluck('id')->random();
            $movie->save();
        }
        Screen::factory()->count(3)->create();
        Schedule::factory(10)->create();

        $this->call(SheetTableSeeder::class);
    }
}
