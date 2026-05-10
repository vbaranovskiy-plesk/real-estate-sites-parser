<?php
namespace App;
use App\Site\SiteInterface;
use App\Archiver\ArchiverInterface;
use App\Telegram\TelegramSender;


class Report
{
    public function __construct(
        private readonly array $sites,
        private readonly ArchiverInterface $archiver,
        private readonly ?TelegramSender $telegramSender
    ) {
    }

    public function make(): void
    {
        $reportPath = __DIR__ . DIRECTORY_SEPARATOR .  '..' . DIRECTORY_SEPARATOR . 'report' . DIRECTORY_SEPARATOR;
        $generatedFiles = $this->generateReports($reportPath);
        $this->createArchive($generatedFiles, $reportPath);
    }

    private function generateReports(string $reportPath): array
    {
        $generatedFiles = [];

        /** @var SiteInterface $site */
        foreach ($this->sites as $site) {
            $filename = $site->getReportFileName();
            try {
                (new XlsBuilder($reportPath))->createXls($site);
                echo "Report file " . $filename . " is created." . PHP_EOL;
                $generatedFiles[] = $reportPath . $filename;
            } catch (\Throwable $e) {
                echo "Unable create report $filename :" . $e->getMessage() . PHP_EOL;
            }
        }

        return $generatedFiles;
    }

    private function createArchive(array $generatedFiles, string $reportPath): void
    {
        if (empty($generatedFiles)) {
            echo "No reports were generated to archive" . PHP_EOL;
            return;
        }

        try {
            $archiveName = $this->archiver->generateArchiveName();
            $archivePath = $reportPath . $archiveName;

            $this->archiver->createArchive($generatedFiles, $archivePath);
            echo "Archive created: " . $archiveName . PHP_EOL;

            $this->sendToTelegram($archivePath, $archiveName);
        } catch (\Throwable $e) {
            echo "Failed to create archive: " . $e->getMessage() . PHP_EOL;
        }
    }

    private function sendToTelegram(string $archivePath, string $archiveName): void
    {
        if (is_null($this->telegramSender)) {
            return;
        }
        try {
            $caption = "Real Estate Reports - " . date('Y-m-d H:i:s') . "\nFile: " . $archiveName;
            $this->telegramSender->sendDocument($archivePath, $caption);
            echo "Archive sent to Telegram successfully" . PHP_EOL;
        } catch (\Throwable $e) {
            echo "Failed to send archive to Telegram: " . $e->getMessage() . PHP_EOL;
        }
    }
}