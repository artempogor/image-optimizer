<?php

namespace App\Services\DeleteFile;

use Illuminate\Support\Facades\DB;

class OldFilesListService
{
    public function list(): \Illuminate\Support\Collection
    {
        return DB::table('media_files')
            ->whereDate('created_at', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MINUTE)'))
            ->where('is_deleted', false)
            ->get();
    }
}