<?php
namespace App\Archiver;

interface ArchiverInterface
{
    public function createArchive(array $files, string $archivePath): string;

    public function generateArchiveName(): string;
}