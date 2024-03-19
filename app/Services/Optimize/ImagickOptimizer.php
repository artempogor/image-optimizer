<?php

namespace App\Services\Optimize;

use App\Services\Optimize\Exceptions\FailedDropScaleException;
use App\Services\Optimize\Params\OptimizedFileParams;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Imagick;
use ImagickException;

/**
 * Реализация с помощью ImageMagick
 * https://www.php.net/manual/en/book.imagick.php
 */
class ImagickOptimizer implements OptimizeInterface
{
    public function __construct()
    {
    }

    /**
     * @throws ImagickException
     */
    public function compress(UploadedFile $file, int $level = 10): OptimizedFileParams
    {
        $imagick = new Imagick($file->getRealPath());

        try {
            $imagick->setImageCompressionQuality($level);
        } catch (\Throwable $exception) {
            new FailedDropScaleException();
            Log::error($exception->getMessage());
        }

        return new OptimizedFileParams($imagick->getImageBlob(), $file->getClientOriginalName());
    }

    public function upScale(UploadedFile $file, int $level): OptimizeInterface
    {
    }
}