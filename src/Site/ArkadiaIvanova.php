<?php
namespace App\Site;

class ArkadiaIvanova extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'arkadia-ivanova' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/310-q6wGaF/';
    }
}