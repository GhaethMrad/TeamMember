<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $team = Team::factory()->create();
            $users = User::factory(5)->create(['team_id' => $team->id]);
            foreach ($users as $user) {
                Task::factory(5)->create(['team_id' => $team->id, 'user_id' => $user->id]);
            }
        }
    }
}
