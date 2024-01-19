<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelsData = [['level' => 'Manager'], ['level' => 'Staff']];
        DB::table('levels')->insert($levelsData);
    }
}
