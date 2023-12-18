<?php

namespace Database\Seeders;

use App\Models\Severity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/severities.json')), 1);

        Severity::query()->upsert($data, ['id']);
    }
}
