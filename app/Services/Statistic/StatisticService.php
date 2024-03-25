<?php

namespace App\Services\Statistic;

use App\Services\ObjectValues\OperationTypeEnum;
use App\Services\Statistic\Response\StatisticResponse;
use Illuminate\Support\Facades\DB;

class StatisticService
{
    public function getStatistic(): StatisticResponse
    {
        $results = DB::table('media_files')
            ->where('operation', OperationTypeEnum::DOWNSCALE->value)
            ->get();

        return new StatisticResponse(
            count: count($results),
            bytesSummary: $results->sum('optimized_bytes') / 1024,
        );
    }
}