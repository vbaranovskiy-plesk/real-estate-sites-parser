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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImNhNjEzNGEzZGFiODc5NjIwNzZiZjRlNTQ1Y2NiNWNhOTE0ZjlhYjg5MzY3YWQwZDU4MjhmYWI2MzYxZTI1NmZlOGQ2NGQ5MjdkMGRhYTJiIiwiaWF0IjoxNzU5NTg0MzA1LjEzOTY1NywibmJmIjoxNzU5NTg0MzA1LjEzOTY2LCJleHAiOjE3NTk1ODc5MDUuMTMzODY0LCJzdWIiOiJTSVRFX1dJREdFVHwyMjU1Iiwic2NvcGVzIjpbIlNJVEVfV0lER0VUIl0sInR5cGUiOiJzaXRlV2lkZ2V0IiwiZW50aXRsZW1lbnRzIjoiIiwiYWNjb3VudCI6eyJpZCI6MTQyODAsInRpdGxlIjoi0JLQvtC50LrQvtCyIiwic3ViZG9tYWluIjoicGIxNDI4MCIsImJpbGxpbmdPd25lcklkIjoxNDMxNywiY291bnRyeUNvZGUiOiJSVSJ9LCJyb2xlcyI6WyJST0xFX1NJVEVfV0lER0VUIl0sInNpdGVXaWRnZXQiOnsiaWQiOjIyNTUsImRvbWFpbiI6Imh0dHBzOi8vdm9pa292LmNvbSJ9fQ.NA7P6Blv2bUyB56yuMTnVVTum-wS4JPr4uIaCaXFko56SG09GkUMxthEQ088S8qj607BqOug9I8bslyTCJi-Rgjc5d3V408OiYnw6CQYcV1sJrD-op0vJkFqMWwEAJyYD9TGX5o3m-KsGbW_MswUmgr95pJ9J4AFIqQYqdNwH0h35y-HQ7TrEw4rC9shd_w4ZuClsKRg_oz9o-wNYwjWjFBBOGjq7Vgev8ly38rPRmxy2aLBThmTeNpxyN18vUTGyKD_vmi7OcB7HYzqUbn4l4yejs1LHJTISVVpj7xesRtWHggPIDnKDv9YvqDjeBV7gb8pkCUlFGxEOadwBgKLhQ';
    }
}