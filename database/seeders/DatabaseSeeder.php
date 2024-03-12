<?php

namespace Database\Seeders;

// use App\Practice;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     $this->call([
    //         SheetTableSeeder::class,
    //     ]);
    // }
    public function run()
    {
    //    Practice::factory(10)->create();
        Movie::factory(3)->create();
    }
}
