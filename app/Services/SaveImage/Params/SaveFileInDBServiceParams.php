<?php

namespace App\Services\SaveImage\Params;

use App\Services\ObjectValues\OperationTypeEnum;

class SaveFileInDBServiceParams
{
    public function __construct(
        public readonly string            $storage,
        public readonly string            $path,
        public readonly OperationTypeEnum $operation,
        public readonly int $optimizedBytes,
    )
    {
    }
}