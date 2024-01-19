<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positionsData = [['position' => 'HR Manager'], ['level' => 'Digital Marketing'], ['level' => 'Finance Manager'], ['level' => 'Full Stack Web Developer'], ['level' => 'Designer']];
        DB::table('positions')->insert($positionsData);
    }
}
