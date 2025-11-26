<?php
namespace App\Site;

class Avtorskiy extends Profitbase implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'avtorskiy' . '-' . date("Y-m-d") . '.xlsx';
    }

    protected function getSubdomain(): string
    {
        return 'pb6858';
    }

    protected function getHouseIds(): array
    {
        return ['111053'];
    }

    protected function getSiteUrl(): string
    {
        return 'https://xn--80aesedxoig.xn--p1ai';
    }

    protected function getClientId(): string
    {
        return '3315';
    }

    protected function getAuthToken(): string
    {
        // https://xn--80aesedxoig.xn--p1ai/#/catalog/house/111053/smallGrid?filter=property.status:AVAILABLE
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImVmZDA5NTViYWY2OGY3NDEzYTEwOGVhZTQyMmFiMTVlOTQzY2ZjY2UyNGIyYmMyY2UxZDBlMDk1N2Y4YjZiMzkyZDExNDAzOTA1MjE1NWFkIiwiaWF0IjoxNzYzNDgwNTk0LjkwOTkwMiwibmJmIjoxNzYzNDgwNTk0LjkwOTkwNSwiZXhwIjoxNzYzNDg0MTk0LjkwMzE3Mywic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.qh1M5k7ACfdaAqyJSlrobo3H75FDApECOPR6HN0ucOP6Pr3w7DeqO1gp0DbrqjG3o74CaU0h-mD0E1Zbj0GS5eyv89-5QDeJpyVeHYY-SxmHWXb1cNDzjrugMk9HKWoW5UgygdXqtZHKQi_dz2b20PAeD6aBC_sHXAMwkT_8Xb50IPaBtmqWnsXoXrIZTbzRkAWSaL2YYuHjVdhpFTNOp94c7UA2CX_jV_Ja78Gn6J7wLJhvi0akMQgR2Xam-MlgQ8nM_KYtsMPpnGAOvb2n1WIqJ0Kdbut_VyZ_F0UmXmPIeVspwrQfyn4FRVx_NxKi3dkXeVgabGbEkx5UR6l3Mw';
    }
}