<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $baseSeeds = [
        ['column' => 1, 'row' => 'a'],
        ['column' => 2, 'row' => 'a'],
        ['column' => 3, 'row' => 'a'],
        ['column' => 4, 'row' => 'a'],
        ['column' => 5, 'row' => 'a'],
        ['column' => 1, 'row' => 'b'],
        ['column' => 2, 'row' => 'b'],
        ['column' => 3, 'row' => 'b'],
        ['column' => 4, 'row' => 'b'],
        ['column' => 5, 'row' => 'b'],
        ['column' => 1, 'row' => 'c'],
        ['column' => 2, 'row' => 'c'],
        ['column' => 3, 'row' => 'c'],
        ['column' => 4, 'row' => 'c'],
        ['column' => 5, 'row' => 'c'],
      ];

        $seeds = [];
        $id = 1;

        for ($screenId = 1; $screenId <= 3; $screenId++) {
            foreach ($baseSeeds as $baseSeed) {
                $seeds[] = [
                    'id' => $id++,
                    'column' => $baseSeed['column'],
                    'row' => $baseSeed['row'],
                    'screen_id' => $screenId,
                ];
            }
        }

            DB::table('sheets')->insert($seeds);
    }
}
