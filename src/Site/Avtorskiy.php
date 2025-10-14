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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjUzYTA3ZjA4MTk3MjJlODYzNDYzNjM2MTZiZGQ2OGYzNzBkM2M4ZWI0MGIyNmY0ZGY2ZTJmYWIxZTNhZWVkZWEzNWQ5OTQyYmU3NzRiNzkwIiwiaWF0IjoxNzYwNDU1NzY0LjU5ODcwNywibmJmIjoxNzYwNDU1NzY0LjU5ODcxMSwiZXhwIjoxNzYwNDU5MzY0LjU5MjM4Niwic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.AGUwhBaFR5q5Xbc4N5tgwDjBQaaLtvOBh6PdZOgvMEo9n0_MsYyt3eQ88CBqKh9H3nZxx9zQ5aM48nRAvuvnF_Wij-bz5YJqJCY3Z-Xfc02I6-SdK4SDtK1XpsZSZa583JJKYkgwX3yXdK8ydW9O6awlvQKAe-v3hWA3J7PPtnHflOqmTlne2NzBTTM0y2L3jis8m-7jn2jWUaDLlWyijSFJoEbW59rQ17f7pswmGhpdpXoiRp8KdizZfjM1aY_DPkDDFyn8LZVMJ-C08idXhFSFaFr4G2O_CGSui0zpmYyHcoOnGSvmDsDIguudTkx6KR16XshdUUSAH7b9MEzbuw';
    }
}