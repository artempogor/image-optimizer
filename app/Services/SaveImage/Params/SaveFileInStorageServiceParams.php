<?php

namespace App\Services\SaveImage\Params;

use App\Services\ObjectValues\OperationTypeEnum;

class SaveFileInStorageServiceParams
{
    public function __construct(
        public readonly string            $storage,
        public readonly string            $path,
        public readonly int               $bytes,
    )
    {
    }
}