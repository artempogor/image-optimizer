<?php

namespace App\Services\Optimize;

use App\Services\ObjectValues\OperationTypeEnum;
use App\Services\SaveImage\Params\SaveFileInDBServiceParams;
use App\Services\SaveImage\SaveFileInDB;
use App\Services\SaveImage\SaveFileInStorage;
use Illuminate\Http\UploadedFile;
use ImagickException;

class CompressService
{

    public function __construct(
        public readonly SaveFileInStorage $saveFileService,
        public readonly SaveFileInDB      $saveFileInDB,
        public readonly OptimizeInterface $imageProcessor = new ImagickOptimizer(),
    )
    {
    }

    /**
     * @throws ImagickException
     */
    public function compress(UploadedFile $file, int $optimizationLevel = null): array
    {
        $optimizedImage = $this->imageProcessor->compress($file, $optimizationLevel);

        $fileResponse = $this->saveFileService->saveFile($optimizedImage);

        $optimizedBytes = ($file->getSize()) - ($fileResponse->bytes);

        $this->saveFileInDB->save(new SaveFileInDBServiceParams(
            storage: $fileResponse->storage,
            path: $fileResponse->path,
            operation: OperationTypeEnum::DOWNSCALE,
            optimizedBytes: $optimizedBytes
        ));

        $sizeFilePreview = $file->file('image')->getSize();
        $sizeFileAfter = $fileResponse->bytes;

        return [
            'path' => $fileResponse->path,
            'optimized_bytes' => $optimizedBytes,
            'size_file_preview' => $sizeFilePreview,
            'size_file_after' => $sizeFileAfter
        ];
    }
}
