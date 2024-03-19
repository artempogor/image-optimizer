<?php

namespace App\Services\Optimize\Exceptions;

class FailedDropScaleException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Не удалось оптимизировать файл!", 500);
    }
}