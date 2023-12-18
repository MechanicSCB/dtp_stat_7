<?php

namespace Database\Seeders;

use App\Models\AccidentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccidentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/accidentCategories.json')), 1);

        AccidentCategory::query()->upsert($data, ['id']);
    }
}
