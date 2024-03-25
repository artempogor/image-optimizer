<?php

namespace App\Http\Controllers;

use App\Services\Statistic\StatisticService;

class StatisticController
{
    public function __construct(
        public readonly StatisticService $statisticService,
    )
    {

    }

    public function statistic(): \Illuminate\View\View|\Laravel\Lumen\Application
    {
        $results = $this->statisticService->getStatistic();

        return view('statistic', ['statistic' => $results]);
    }
}