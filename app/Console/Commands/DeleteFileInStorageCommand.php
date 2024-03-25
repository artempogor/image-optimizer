<?php

namespace App\Console\Commands;

use App\Services\DeleteFile\OldFilesDeleteInStorageService;
use App\Services\DeleteFile\OldFilesListService;
use App\Services\DeleteFile\OldFilesUpdateService;
use Illuminate\Console\Command;

class DeleteFileInStorageCommand extends Command
{
    public function __construct(
        public readonly OldFilesDeleteInStorageService $deleteInStorageService,
        public readonly OldFilesListService            $oldFilesListService,
        public readonly OldFilesUpdateService          $oldFilesUpdateService,
    )
    {
        parent::__construct();
    }

    protected $signature = 'file:delete_old';

    protected $description = 'Удаляет старые файлы из хранилища';

    public function handle(): void
    {
        $fileForDelete = $this->oldFilesListService->list();

        if ($fileForDelete->isEmpty()) {
            $this->info('Нет файлов для удаления');
            return;
        }

        $idsForUpdate = $this->deleteInStorageService->delete($fileForDelete);

        $this->oldFilesUpdateService->batchUpdateIsDeletedFlag($idsForUpdate);

        $this->info('Хранилище очищено, файлов удаленно: ' . count($idsForUpdate));
    }
}