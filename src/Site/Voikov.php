<?php
namespace App\Site;

class Voikov extends TokenPrefetch implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'voikov' . '-' . date("Y-m-d") . '.xlsx';
    }

    protected function getSubdomain(): string
    {
        return 'pb14280';
    }

    protected function getHouseIds(): array
    {
        return ['130502'];
    }

    protected function getSiteUrl(): string
    {
        //https://voikov.com/#/catalog/house/130502/smallGrid?filter=property.status:AVAILABLE
        return 'https://voikov.com';
    }

    protected function getClientId(): string
    {
        return '2255';
    }
}