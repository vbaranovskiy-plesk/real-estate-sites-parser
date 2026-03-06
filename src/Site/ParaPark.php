<?php
namespace App\Site;

class ParaPark extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'para-park' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/539-qSuwul/';
    }
}

