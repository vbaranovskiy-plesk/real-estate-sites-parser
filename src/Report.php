<?php
namespace App;
use App\Site\SiteInterface;


class Report
{
    public function __construct(private readonly array $sites)
    {
    }

    public function make(): void
    {
        $reportPath = __DIR__ . DIRECTORY_SEPARATOR .  '..' . DIRECTORY_SEPARATOR . 'report' . DIRECTORY_SEPARATOR;
        /** @var SiteInterface $site */
        foreach ($this->sites as $site) {

            $filename = $site->getReportFileName();
            try {
                (new XlsBuilder($reportPath))->createXls($site);
                echo "Report file " . $filename . " is created." . PHP_EOL;
            } catch (\Throwable $e) {
                echo "Unable create report $filename :" . $e->getMessage() . PHP_EOL;
            }
        }
    }
}