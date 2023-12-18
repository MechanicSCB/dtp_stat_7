<?php

namespace Database\Seeders;

use App\Models\ParticipantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/participantCategories.json')), 1);

        ParticipantCategory::query()->upsert($data, ['id']);
    }
}
