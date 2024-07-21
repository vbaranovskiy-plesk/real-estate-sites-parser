<?php
namespace App\Site;

class Zaozernyi extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'zaozenrnyi' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/287-OhYjjj/';
    }
}