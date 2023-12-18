<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // $chartsData = [
        //     "main_stat" => [
        //         [
        //             "number_of_points" => 113003,
        //             "participants_count" => 281729,
        //             "dead_count" => 12510,
        //             "injured_count" => 141799,
        //         ],
        //     ],
        //     'severities' => [
        //             "labels" => [
        //                 "Легкий",
        //                 "Тяжёлый",
        //                 "С погибшими"
        //             ],
        //             "colors" => [
        //                 "#FACC15",
        //                 "#F97316",
        //                 "#DC2626"
        //             ],
        //             "data" => [
        //                 152582,
        //                 81092,
        //                 24711
        //             ],
        //     ],
        // ];
        $chartsData = $this->getChartData('sfsf');

        $time = tmr();

        return inertia('Charts/Index', compact(
            'chartsData',
            'time'
        ));
    }

    public function getChartData(string $chart): array
    {
        $accidents = DB::table('accidents');

        $chartsData['main_stat'] = $this->getMainStat($accidents);
        $chartsData['main_stat']['time'] = tmr();

        return $chartsData;
    }

    private function getChartsData(array $filter): array
    {
        $accidents = DB::table('accidents');
        // $accidents = $this->filterAccidents($accidents, $filter);

        $chartsData = [];

        $chartsData['main_stat'] = $this->getMainStat(clone($accidents));
        $chartsData['severities'] = $this->getSeveritiesChartData(clone($accidents));
        $chartsData['light_conditions'] = $this->getLightConditionsChartData(clone($accidents));
        // $chartsData['months'] = $this->getMonthsChartData(clone($accidents));
        // $chartsData['weekdays'] = $this->getWeekdaysChartData(clone($accidents));
        // $chartsData['hours'] = $this->getHoursChartData(clone($accidents));

        return $chartsData;
    }

    private function getMainStat(Builder $filteredAccidents): array
    {
        $mainStat = $filteredAccidents
            ->selectRaw("count(id) as number_of_points, sum(participants_count) as participants_count, sum(dead_count) as dead_count, sum(injured_count) as injured_count")
            ->get()
            ->toArray();

        return $mainStat;
    }

    private function getSeveritiesChartData(Builder $filteredAccidents): array
    {
        $severities = [
            1 => ['name' => 'Легкий', 'color' => '#FACC15'],
            2 => ['name' => 'Тяжёлый', 'color' => '#F97316'],
            3 => ['name' => 'С погибшими', 'color' => '#DC2626'],
        ];

        $data = $filteredAccidents
            ->selectRaw("count(id) as number_of_points, severity_id")
            ->groupBy('severity_id')
            ->orderBy('severity_id')
            ->get()
        ;

        $severitiesChartData = [];

        foreach ($data as $item) {
            $severitiesChartData['labels'][] = $severities[$item->severity_id]['name'];
            $severitiesChartData['colors'][] = $severities[$item->severity_id]['color'];
            $severitiesChartData['data'][] = $item->number_of_points;
        }

        return $severitiesChartData;
    }

    private function getLightConditionsChartData(Builder $filteredAccidents): array
    {
        $data = $filteredAccidents
            ->selectRaw("count(id) as number_of_points, light_conditions_id")
            ->groupBy('light_conditions_id')
            ->pluck('number_of_points', 'light_conditions_id');

        $lightConditionsChartData['labels'] = $data->keys()->toArray();
        $lightConditionsChartData['data'] = $data->values()->toArray();

        return $lightConditionsChartData;
    }

    private function getMonthsChartData(Builder $filteredAccidents): array
    {
        $data = $filteredAccidents
            ->selectRaw('count(id) as number_of_points, sum(dead_count) as dead_count, sum(injured_count) as injured_count, "year-month"')
            ->groupBy('year-month')
            ->orderBy('year-month')
            ->get();

        $montChartData['labels'] = $data->pluck('year-month')->map(fn($v) => Carbon::parse($v)->isoFormat('MMM YYYY'));
        $montChartData['number_of_points'] = $data->pluck('number_of_points');
        $montChartData['dead_count'] = $data->pluck('dead_count');
        $montChartData['injured_count'] = $data->pluck('injured_count');

        return $montChartData;
    }

    private function getWeekdaysChartData(Builder $filteredAccidents): array
    {
        $data = $filteredAccidents
            ->selectRaw('count(id) as number_of_points, sum(dead_count) as dead_count, sum(injured_count) as injured_count, weekday')
            ->groupBy('weekday')
            ->orderBy('weekday')
            ->get();

        $days = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб']; //$days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];

        $weekdaysChartData['labels'] = $data->pluck('weekday')->map(fn($v) => $days[$v]);
        $weekdaysChartData['number_of_points'] = $data->pluck('number_of_points');
        $weekdaysChartData['dead_count'] = $data->pluck('dead_count');
        $weekdaysChartData['injured_count'] = $data->pluck('injured_count');

        return $weekdaysChartData;
    }

    private function getHoursChartData(Builder $filteredAccidents): array
    {
        $data = $filteredAccidents
            ->selectRaw('count(id) as number_of_points, sum(dead_count) as dead_count, sum(injured_count) as injured_count, hour')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hoursChartData['labels'] = $data->pluck('hour');
        $hoursChartData['number_of_points'] = $data->pluck('number_of_points');
        $hoursChartData['dead_count'] = $data->pluck('dead_count');
        $hoursChartData['injured_count'] = $data->pluck('injured_count');

        return $hoursChartData;
    }

}
