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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjZlMWEyM2U4NzZhNjFjYWI2NGQ1YTA1ZDNmZTI5YWYyM2M0OTA0OThkYjZiNjgyMTY5ZDIxNjYyY2JlMzFlMWY1ZjhkZmUzYWU3MmJjNGE2IiwiaWF0IjoxNzU5NTkwMTMwLjEwMzE4NywibmJmIjoxNzU5NTkwMTMwLjEwMzE5LCJleHAiOjE3NTk1OTM3MzAuMDk5NDE1LCJzdWIiOiJTSVRFX1dJREdFVHwzMzE1Iiwic2NvcGVzIjpbIlNJVEVfV0lER0VUIl0sInR5cGUiOiJzaXRlV2lkZ2V0IiwiZW50aXRsZW1lbnRzIjoiIiwiYWNjb3VudCI6eyJpZCI6Njg1OCwidGl0bGUiOiLQkNC60LDQtNC10LzQuNGPIiwic3ViZG9tYWluIjoicGI2ODU4IiwiYmlsbGluZ093bmVySWQiOjY4OTUsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjozMzE1LCJkb21haW4iOiJodHRwczovL3huLS04MGFlc2VkeG9pZy54bi0tcDFhaSJ9fQ.qZYj6dmPUVmZvsPGTZhn6_ITcWQv0Mm45dsWBawRjDpYP00Q6FYmlV7hoLOW2StNfSfyRA-vYNN0NgoAPXSIy9KrIVVzonN5ojIUWODivBj_Hnsz9uPJ6KQunPLxLa5ckCYnyZrTJ7k5wpGWe6Y9QQNPKwM36hR2qn4nUPdAXp_BtiahomhkpVO9pcUq30gL1qGw1Qtji2pQ5TXE3q4zhZRykQ3aOgYXLjncZmcntg-6l47tPkkmpDb1tAhMP2MMEAR474C8difHJWl9CXY1qm8zLbJ6V57ZqNlKVTt43zK-viCRLIhfrIfpuySHACIIBbfQ-7-QyfBQmsAy80wTxg';
    }
}