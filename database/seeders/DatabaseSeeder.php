<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Bill;
use App\Models\Service;
use App\Models\User;
use App\Models\Workspace;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'demo1',
            'password' => 'skills2023d1',
        ]);

        User::factory()->create([
            'name' => 'demo2',
            'password' => 'skills2023d2',
        ]);

        //Service
        Service::factory()->create([
            'name' => 'posts'
        ]);

        Service::factory()->create([
            'name' => 'books'
        ]);

        Workspace::factory()->create();

        ApiToken::factory()->create();

        ApiToken::factory()->create([
            'name' => 'Production',
        ]);

        Bill::factory()->create();

        Bill::factory()->create([
            'cost_per_ms' => 0.001,
            'api_token_id' => 2,
        ]);

        Bill::factory()->create([
            'cost_per_ms' => 0.09,
            'api_token_id' => 2,
        ]);

    }
}
