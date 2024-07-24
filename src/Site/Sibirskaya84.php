<?php
namespace App\Site;

class Sibirskaya84 extends Sibirskaya74 implements SiteInterface
{
    protected function getUrl(): string
    {
        return 'https://tsz.tomsk.ru/objektyi/zhk-sibirskaya-84/';
    }

    public function getReportFileName(): string
    {
        return 'sibirskaya84' . '-' . date("Y-m-d") . '.xlsx';
    }
}