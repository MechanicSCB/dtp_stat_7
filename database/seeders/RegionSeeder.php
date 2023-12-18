<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = file_get_contents(database_path('seeders/src/regions.csv'));
        $csv = explode("\n",$csv);
        $headers = array_shift($csv);
        $headers = trim($headers, '"');
        $headers = explode('","',$headers);

        $regions = [];

        foreach ($csv as $row){
            $row = str_replace(',NULL,', ',"NULL",', $row);
            $row = trim($row, '"');
            $values = explode('","',$row);
            $values = array_map(fn($v) => $v === 'NULL' ? null : $v, $values);

            if(count($values) !== count($headers)){
                continue;
            }

            $regions[] = array_combine($headers, $values);
        }

        Region::query()->upsert($regions, ['id']);
    }
}
