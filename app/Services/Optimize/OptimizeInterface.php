<?php

namespace App\Services\Optimize;

use Illuminate\Http\UploadedFile;

interface OptimizeInterface
{
    public function compress(UploadedFile $file, int $level);

    public function upScale(UploadedFile $file, int $level);
}