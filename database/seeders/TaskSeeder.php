<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $projects = DB::table('projects')->get();
        $priority = 1;

        $faker = Faker::create();

        foreach ($projects as $project) {
            $tasks = [];

            for ($i = 1; $i <= 3; $i++) {
                $tasks[] = [
                    'name' => 'Task - '.$faker->sentence(3),
                    'priority' => $priority,
                    'project_id' => $project->id,
                    'created_at' => now(),
                ];
                $priority++;
            }

            DB::table('tasks')->insert($tasks);
        }
    }
}
