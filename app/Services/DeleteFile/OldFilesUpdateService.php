<?php

namespace App\Services\DeleteFile;

use Illuminate\Support\Facades\DB;

class OldFilesUpdateService
{
    public function batchUpdateIsDeletedFlag($idsForUpdate): int
    {
        return DB::table('media_files')
            ->whereIn('id', $idsForUpdate)
            ->update(['is_deleted' => true]);
    }
}