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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjcwZDY0YTU3OGVhZDQyMDBmMTZiNzVhZDUyNDFkMGM4YjIzY2YwZTQzZDI3ODI2NTZjNzE3ZWRkOGViM2E1ZmZhNjY0YzcyMjBmZWZkNDdmIiwiaWF0IjoxNzY2NDcwODMyLjI1MDE0NiwibmJmIjoxNzY2NDcwODMyLjI1MDE0OCwiZXhwIjoxNzY2NDc0NDMyLjIzOTU4Niwic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.gbqk9ndD5kyFWvrxf9UE6AO3M2SXKtjijqedVYrfpVVCmkxFMlsrWiMdbahlsXbbKwn6NgyScSK31PrL2nFf9ld6rLtE9m6mRBv9DD3K8eYiTqWpli131KvkTOPY6nkP2yOT58pcPERO7G-iKlTezdu15bZWRir2OnjciJ-4UHjqERvBxE9TXydUg3gea6IP5coTvrIjRkH6MCLvOiBl0oSEHy2NcVm3JmdWvFOZ4CBVfhHxk7n4p__HgNg6VcIkk7r2ymEP_sCwBcRbQG_9tdZ-rQF4J3N3BUasLrxqSLkoJn-BoQQrJBgo9x9tsoh3FDrPOpldqbU0SkitKq_qhA';
    }
}