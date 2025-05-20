<?php
namespace App\Site;

class PoeziaHouse extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'poezia-house' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/359-2tXpIm/';
    }
}

