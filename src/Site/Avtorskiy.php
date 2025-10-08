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
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjIzMjE5MjZkMDBlNTZjY2YyYTVhMTkzMWJmN2FiNjBjNzA5YTYxMmVhN2RhMjE1OTUwYzBjMjZkZjNmZTJjOWJiYjZlZmIxMTQ0ZDMxNmQyIiwiaWF0IjoxNzU5OTQwNDA3LjUxMDExMSwibmJmIjoxNzU5OTQwNDA3LjUxMDExNCwiZXhwIjoxNzU5OTQ0MDA3LjQ5NjI1Mywic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.YyEQbjPJHg0Rt6lvScBYD752QoSzRlJlAsWxXmuvLLaZWmymEMtXcch51bElU4QByfego0sxVA8YFQ2ZC9hXtdW-FrzswNPSJTJXQuDZ15hJbhjv8Xm7-oeil5qFIkyr3FYbxS4WpzE7uwZe1sixUMLDufxb6CRITuFIKueZuyy2DA91h_Nx9lJp2_JXiI5pdfgW0IgsWtaZwLoxx0TvcnLZwOWCe3YkeioBjEHaVl5BMc2HdNT7EubS160WF3PNj-NGDPUVdG9uWFEL2Hr1k0-JyjtIGVVWPJkxn_r-EbbUm_zUKGFyh2jrLkLiVdF_poabuiv0vIlJdv9FrjOGuA';
    }
}