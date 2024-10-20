<?php

namespace Database\Seeders;

use App\Models\Commende;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommendeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commende::factory()->count(10)->create();

    }
}
