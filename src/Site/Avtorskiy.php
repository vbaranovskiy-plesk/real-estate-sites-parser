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
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImFhMGU1NzRkN2M1OTRlNmE3NWZiYmE1NjVkZTg0NDgxNTY3OTMyMWU2MjMwODk3MDVlMjA4MDMwZmEzMjI2MDBhMTc4ZjYzMWRjZTdkN2JhIiwiaWF0IjoxNzUxMjAzMTA4Ljg0MjU1NCwibmJmIjoxNzUxMjAzMTA4Ljg0MjU1NywiZXhwIjoxNzUxMjA2NzA4LjgzNTY4MSwic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.GamwEpcM-HK3aQ0-8hWy6_daJaF6zUH2QJUzdJK0Q_jUKdtgi7j4DysCGndjeaT8PsPnxyoRElMpqJwuzbi3P943W-1E8ZPCZl4Qi0R3XY_jY-sW5w7jYNowNfQy6gPma5McUugb2HeKEaRZzSbJUzrgoNgIBqrKhKfHnNWHmyVq6w7Z7Hff-PW0MDeGv63kFL8pCkaJKOLi9ic5Mf2olDM2SQgXzIzE2BP94_eX-aa1Y7lXYkYgdGxSbZTZ6CCg2k2zIb33L1fQzWt2CzmJcc2FvDuXWADz6XYRhgGAnbYXcZUVs_7zIjcGUNyCpvracGvb_cdmHtWdw2-qCx1zbA";
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