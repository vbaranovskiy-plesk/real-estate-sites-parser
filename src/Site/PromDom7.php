<?php
namespace App\Site;

class PromDom7 extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'promdom7' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/417-ww716s/';
    }
}