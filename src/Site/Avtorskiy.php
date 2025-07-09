<?php
namespace App\Site;

class Avtorskiy implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'avtorskiy' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['111053'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        // https://xn--80aesedxoig.xn--p1ai/#/catalog/house/111053/smallGrid?filter=property.status:AVAILABLE
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImFiZTU0YTg3YWJhYzYyZGRkMjFmNGZlM2M2NmYzZTg1ZDliZmVjMDljMzA1ZjllZmZhMDJlZGYxN2IwMjdmODc2MGQ3Y2RkMTcyZjNiMjRjIiwiaWF0IjoxNzUyMDI4NzI5LjczNzE3OCwibmJmIjoxNzUyMDI4NzI5LjczNzE4MSwiZXhwIjoxNzUyMDMyMzI5LjczMzEyNywic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.N75hjw0liZEVQqJpQrvA2--GXLQWqj-TBrPQSHoki0gfz5EoX9UiZ7s3N5G8xEPNR9lqW9unGItR7wiKT5UEUF2MeDiHmvQLYEu3C-JFD_FBZHcpkHBX5tR99m9CJ02fZzUybkDA1UqXiUsDWIHdDHsTu8GhUK3PTPkNvnebkmS4camzOpPysIfMmnweYURLQOU9ntSJfCGsNlLMEBJZsIMJxHSftE9T4fKU_MEFSnmaxvFAZoyDvW649D4ceMn5nWkV0DCglbuYEZTXI-LLoH-EjIs62dHxSOv-GsaSf4JnThN3kImDWP5T5IwBiOmehXmbN6aDUYoAVg5hcMy0sw";
        $ch = curl_init("https://pb6858.profitbase.ru/api/v4/json/property?houseId=111053&returnFilteredCount=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ $authorization ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $curlResult = curl_exec($ch);
        if (!$curlResult) {
            throw new \Exception('Unable to get info about koroleva estate: ' . curl_error($ch));
        }
        curl_close($ch);
        $data = json_decode($curlResult, true);
        $result = [];
        foreach ($data['data']['properties'] as $flat) {
            if (!$flat['number']) {
                continue;
            }
            $result[] = [
                'number' => $flat['number'],
                'area' => $flat['area']['area_total'],
                'price' => (string)$flat['price'],
                'rooms' => $flat['rooms_amount'],
                'section' => $flat['sectionName'],
                'floor' => $flat['floor'],
                'status' => $flat['status'],
                'house_name' => $flat['houseName'],
            ];
        }

        return $result;
    }
}