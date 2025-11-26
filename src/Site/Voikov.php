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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6Ijk1NmU2NGUzZGQwMjE4ZjljMjYyNjRhYmNhOWY5MGI5NzY5ZGU2ZGEyNzZmN2JhYjllMzY5Y2ZiYmQ5YmI4ZTllNjZlNjhiYjEzMjQzNzJjIiwiaWF0IjoxNzY0MTI0MTI0LjU4MzQzNiwibmJmIjoxNzY0MTI0MTI0LjU4MzQzOSwiZXhwIjoxNzY0MTI3NzI0LjU3ODQzMywic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.g4HzmlqTtlKVmkXxX3xip7fGzDmf645LUiihVTbZ1NWa_g6rYpzzR4jYgxk7ybyCmQ2iAzIvNp6WcM-7zYqPMKDmCxrFLOF2XB1ZP5d-1uYv8Uz_qx_xCebWmVtlgbtsg9gEFMgrOZTyY6C4nAKuD4g0DN4qlivUq5uDLfXuaEEQlKePZ_t26R0kAtlMqVe1dk69ZLGfrGhdFpf65zT2gtBxiTHMaO2XaWIkN6g15CPTGhNJmMAt_JZjzz33NEIjuxrKgUO0mWC0vi9V2mekm3H-7edOn2X3gEEYzW5jCt-hKBW773CALS_hKTEYDkMlPzCZqBVIsfOkKiMZGgvYAQ';
    }
}