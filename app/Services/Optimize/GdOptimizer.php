<?php

namespace App\Services\Optimize;

use App\Services\Optimize\Exceptions\FailedDropScaleException;
use App\Services\Optimize\Params\OptimizedFileParams;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

/**
 * Реализация с помощью GD
 * https://www.php.net/manual/ru/book.image.php
 */
class GdOptimizer implements OptimizeInterface
{
    public function __construct()
    {
    }

    public function compress(UploadedFile $file, int $level = 10): OptimizedFileParams
    {
        try {
            $image = imagecreatefromjpeg($file->getRealPath());
            ob_start();
            imagejpeg($image, null, $level);
            $imageBlob = ob_get_contents();
            ob_end_clean();
        } catch (\Throwable $exception) {
            new FailedDropScaleException();
            Log::error($exception->getMessage());
        }

        return new OptimizedFileParams($imageBlob, $file->getClientOriginalName());
    }

    public function upScale(UploadedFile $file, int $level): OptimizeInterface
    {
        // TODO: Implement upScale() method.
    }
}