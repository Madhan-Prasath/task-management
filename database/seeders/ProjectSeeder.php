<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            ['name' => 'Project 1'],
            ['name' => 'Project 2'],
            ['name' => 'Project 3'],
            ['name' => 'Project 4'],
            ['name' => 'Project 5'],
        ];

        DB::table('projects')->insert($projects);
    }
}
