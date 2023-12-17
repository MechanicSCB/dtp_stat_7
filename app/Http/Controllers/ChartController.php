<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $chartsData = [
            "main_stat" => [
                [
                    "number_of_points" => 113003,
                    "participants_count" => 281729,
                    "dead_count" => 12510,
                    "injured_count" => 141799,
                ],
            ],
            'severities' => [
                    "labels" => [
                        "Легкий",
                        "Тяжёлый",
                        "С погибшими"
                    ],
                    "colors" => [
                        "#FACC15",
                        "#F97316",
                        "#DC2626"
                    ],
                    "data" => [
                        152582,
                        81092,
                        24711
                    ],
            ],
        ];

        $time = tmr();

        return inertia('Charts/Index', compact(
            'chartsData',
            'time'
        ));
    }
}
