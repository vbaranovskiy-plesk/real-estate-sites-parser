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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6Ijc1ZDZjYzhlZGYwYjRkN2MzZDYzNmE5NjAwZjA4OTI2NTljMDI2M2Y5YjE0ZGYxNmM5YjU1ZDFkYzlmNmFkMzNmYjdhODAxMGM4YmQ5NWQzIiwiaWF0IjoxNzYwNDU1ODMzLjY1NjE1MiwibmJmIjoxNzYwNDU1ODMzLjY1NjE1NSwiZXhwIjoxNzYwNDU5NDMzLjY1MTM4Nywic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.s7HNnPa8RG8-5ALfLAcwf4IFkJBfOQ3OejYCYiCBxbnzmDI_lZ0rSHIPU5io1gFMFf0m85wTT1ZQejnoPZUYr-lHAr0nhgl13wkW723HR6MYB-vbyz0KTxad_6xISd06rYqvcp5wXFPb9im1-4-KEjKxBwFFq9HYAE90EmlBNbmXRMswqc7nZZxkt8EG-JXXJWrkdbRTHSSJwB1ha15LA4VZQC7CHnpKAYs5ADvlElEYYTMYkMhgFnCnnfiDnlthJZveTv137IGQ044yJxfsF1CIQrx9PHuqTHVDK9HHIUzlXZ4whlWQgENQSM8s6kzrKK3Nh3PbnR8waQPPsoIG5A';
    }
}