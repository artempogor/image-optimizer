<?php

namespace App\Services\SaveImage;

use App\Services\Optimize\Params\OptimizedFileParams;
use App\Services\SaveImage\Params\SaveFileInStorageServiceParams;

class SaveFileInStorage
{
    public function saveFile(OptimizedFileParams $file, string $outputPath = null): SaveFileInStorageServiceParams
    {
        $savedPath = $outputPath ?? $this->savedPath();

        if (!file_exists($savedPath) && !mkdir($savedPath, 0777, true) && !is_dir($savedPath)) {
            throw new \RuntimeException(sprintf('Директория "%s" не создана', $savedPath));
        }

        $savedFile = $savedPath . DIRECTORY_SEPARATOR . $file->filename;

        file_put_contents($savedFile, $file->blob);

        return new SaveFileInStorageServiceParams(
            storage: 'local',
            path: $savedFile,
            bytes: filesize($savedFile)
        );
    }

    private function savedPath(): string
    {
        return 'storage'
            . DIRECTORY_SEPARATOR
            . date('Ymd')
            . DIRECTORY_SEPARATOR
            . uniqid('', true);
    }
}