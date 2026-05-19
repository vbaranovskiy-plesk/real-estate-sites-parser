<?php
namespace App\Site;

class Solo extends TokenPrefetch implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'solo' . '-' . date("Y-m-d") . '.xlsx';
    }

    protected function getSubdomain(): string
    {
        return 'pb20166';
    }

    protected function getHouseIds(): array
    {
        return ['132240'];
    }

    protected function getSiteUrl(): string
    {
        return 'https://nordic.city';
    }
}