<?php

namespace App\Services\Optimize\Params;

class OptimizedFileParams
{
    public function __construct(
        public string $blob,
        public string $filename
    )
    {

    }
}