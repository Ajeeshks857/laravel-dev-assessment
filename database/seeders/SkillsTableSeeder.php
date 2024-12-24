<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            ['name' => 'Laravel', 'status' => 0],
            ['name' => 'Inertia', 'status' => 0],
            ['name' => 'Vue', 'status' => 0],
            ['name' => 'Livewire', 'status' => 0],
            ['name' => 'Alpine', 'status' => 0],
            ['name' => 'TailwindCSS', 'status' => 0],
        ];

        DB::table('skills')->insert($skills);
    }
}
