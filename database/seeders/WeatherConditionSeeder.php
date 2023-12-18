<?php

namespace Database\Seeders;

use App\Models\WeatherCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/weatherConditions.json')), 1);

        WeatherCondition::query()->upsert($data, ['id']);
    }
}
