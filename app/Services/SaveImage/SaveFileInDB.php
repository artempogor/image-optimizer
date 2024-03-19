<?php

namespace App\Services\SaveImage;

use App\Services\SaveImage\Params\SaveFileInDBServiceParams;
use Illuminate\Support\Facades\DB;

class SaveFileInDB
{
    public function save(SaveFileInDBServiceParams $params): bool
    {
        return DB::table('media_files')->insert([
            'operation' => $params->operation->value,
            'storage' => $params->storage,
            'path' => $params->path,
            'optimized_bytes' => $params->optimizedBytes,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}