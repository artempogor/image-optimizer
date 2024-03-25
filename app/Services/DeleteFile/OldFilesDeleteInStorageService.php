<?php

namespace App\Services\DeleteFile;

class OldFilesDeleteInStorageService
{
    public function delete($fileForDelete): array
    {
        $idsForUpdate = [];

        $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);

        foreach ($fileForDelete as $file) {
            if (file_exists($base_dir . '/public/' . $file->path)) {
                $idsForUpdate[] = $file->id;

                unlink($base_dir . '/public/' . $file->path);
            }
        }

        return $idsForUpdate;
    }
}