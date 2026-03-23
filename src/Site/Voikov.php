<?php
namespace App\Site;

class Voikov extends Profitbase implements SiteInterface
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

    protected function getAuthToken(): string
    {
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImQ3Njk5YmM3MmM2MjE5YTQ3NzA0OTlkYjdhNDQzZDJmZWUxMTE2Mjk4N2Y2OWNmNDM5MWFhNTZlNGUxZmRjNGRjMTA1MGMwZTM1NjMyZWRlIiwiaWF0IjoxNzc0MjUyNzkwLjExNDE3MywibmJmIjoxNzc0MjUyNzkwLjExNDE3NSwiZXhwIjoxNzc0MjU2MzkwLjEwNjQ2NSwic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.oy0IsstKW78BBcLBi-DGSxh1k17mFr5TO0I473fdbwXTklCWFF3BaAKTW8aTNcmZ6Fdj8icA_u1Yw-GSXOpCKTus-T5CvilwGbBGYEjiTpVrMIHrCFcBJB3TjLFqGk-w7_i6ctvVBCwuQhgswEPJFo_hZTgXcjaUv80GuUIjjLgQUDcqQJtr0ERXX3XqBNSDdrOgktDpAUtOGBMydj9JEv2ub1m-wLyFmfZCDoMshw6p2UFlwM4BtcEX-CXxKzGldtvhrS2QUpKxPwlePpb72P92dC3lMW0cOGnQibq5OGHM4jSDKYAov6_mWDPZPuBgIzUM7YOomxWnQ5BuXuqH5Q';
    }
}