<?php

namespace Database\Seeders;

use App\Models\Subregion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubregionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/src/subregions.json')), 1);

        Subregion::query()->upsert($data, ['id']);
    }
}
