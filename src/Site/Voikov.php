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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjFiNjc0OWMzMjg4ZjI2Y2Q2M2YxNjcxMTg4M2I2NjBlNzVhOWIwOTRlY2U0M2UzYmY0MTQ4NTMyM2M4OWU4ODNmOGNiNjU5Mzk5MGMyOThmIiwiaWF0IjoxNzcyNzc0MTc0LjE2NDg0NywibmJmIjoxNzcyNzc0MTc0LjE2NDg1LCJleHAiOjE3NzI3Nzc3NzQuMTM3MjI0LCJzdWIiOiJTSVRFX1dJREdFVHwyMjU1Iiwic2NvcGVzIjpbIlNJVEVfV0lER0VUIl0sInR5cGUiOiJzaXRlV2lkZ2V0IiwiZW50aXRsZW1lbnRzIjoiIiwiYWNjb3VudCI6eyJpZCI6MTQyODAsInRpdGxlIjoi0JLQvtC50LrQvtCyIiwic3ViZG9tYWluIjoicGIxNDI4MCIsImJpbGxpbmdPd25lcklkIjoxNDMxNywiY291bnRyeUNvZGUiOiJSVSJ9LCJyb2xlcyI6WyJST0xFX1NJVEVfV0lER0VUIl0sInNpdGVXaWRnZXQiOnsiaWQiOjIyNTUsImRvbWFpbiI6Imh0dHBzOi8vdm9pa292LmNvbSJ9fQ.BcHBUGFZHDJjPONu2LzPAhnQ24PboYj7nBy62UxtqlBV_SiRF1V3evmpjcuF4IqbfM_ykiYZAbKyrfUx4cuBb1aHUHU7Yhtef32KETZ3BcfJgRzfeMEESvyBvIrDOAls_NRvI8s_NNTM7pHqs0RD5CjKWjSRskFd1qUFMVX35__JvhIAPGTogEQ9RvvwbiEqTJyH12SuGFTDEvKyG4zMnvxdJNKXb50Ihyi0DjOsfP6Rh7mwANaVICM66YzI3RDg6VrPeNyTceFj0b1RAlAT0CPvtcr4wMkZ4dFGdtUZvfmbIS1bfOGE4RGZX9zLjm1dVPKNLifPudWI2mmMDq2pPw';
    }
}