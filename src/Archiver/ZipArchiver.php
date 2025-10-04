<?php
namespace App\Archiver;

use Exception;

class ZipArchiver implements ArchiverInterface
{
    public function createArchive(array $files, string $archivePath): string
    {
        if (empty($files)) {
            throw new Exception('No files provided to archive');
        }

        $zip = new \ZipArchive();
        if ($zip->open($archivePath, \ZipArchive::CREATE) !== TRUE) {
            throw new Exception("Cannot create zip file: $archivePath");
        }

        foreach ($files as $filePath) {
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($filePath));
            }
        }

        $zip->close();
        return $archivePath;
    }

    public function generateArchiveName(): string
    {
        return 'reports-' . date('Y-m-d-H-i-s') . '.zip';
    }
}