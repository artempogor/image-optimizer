<?php

namespace App\Services\Statistic\Response;

class StatisticResponse
{
    public function __construct(
        public readonly int $count,
        public readonly int $bytesSummary,
    )
    {

    }
}