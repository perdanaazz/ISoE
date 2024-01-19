<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisionsData = [['division' => 'HRD'], ['division' => 'Marketing'], ['division' => 'Finance'], ['division' => 'IT'], ['division' => 'Creative']];
        DB::table('divisions')->insert($divisionsData);
    }
}
