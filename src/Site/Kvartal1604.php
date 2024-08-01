<?php
namespace App\Site;

class Kvartal1604 extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'kvartal1604' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/216-N873dN/';
    }
}