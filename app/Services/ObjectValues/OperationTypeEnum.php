<?php

namespace App\Services\ObjectValues;

enum OperationTypeEnum: string
{
    case DOWNSCALE = 'down-scale';

    case UPSCALE = 'up-scale';
}
