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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImIzYmU4YTRkZDI1NjE5NGRjYzExOWIzNTI1Zjk2ZjgyZWYwYzg0N2YxMjZmZDE3YTlhOGIyNWE3NjIxM2E5MDQ1ZWRjMTAxOTdlOGNiMjcyIiwiaWF0IjoxNzU5NTkxNDExLjU4NTE0MSwibmJmIjoxNzU5NTkxNDExLjU4NTE0MywiZXhwIjoxNzU5NTk1MDExLjU3OTAxMywic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.J0YuF-SVDdYoWzuHMxVDRZZ4wribcK-FkXpZ15dzAVmBh4GPBoVOfR6j3VpVCtpz8gA-xTGZ_ME3V8CdbDH26KtzOuh54m8SeJ8qZFPuXVMoxJmhGcRc4K3U7W7F83goq3wyG4DjB1utRCH1hboDAAbaRsuJ0hSYHJjmIWUMElM-3OGQ6USdOUNxTH0sNJ7CFvzERYLjVmgnWaKyLg4oljIvgIiNNtkr_Q5BMAEnRVQIWW-pLgJ5IwsuLES8DBXU7MM9NbJbXBwOfizc3uw9tVnN35VxhSXvcjioW24rrx2SmjDeZDzJxPm6fkpofYu7iDLBOZ7UURG_o2icwEdKOg';
    }
}