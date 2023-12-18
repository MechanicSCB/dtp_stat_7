<?php

namespace Database\Seeders;

use App\Models\LightCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LightConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/lightConditions.json')), 1);

        LightCondition::query()->upsert($data, ['id']);
    }
}
