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
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjQ5NDgxOGY1OTBjOGY2MjZmNzc5ZDlkMWRjOWMxNDFlODQ2N2RhN2NkODdlOWQwYTlhZWI3NDZkODY3MzgzODUzZTBlN2MwZDMyZWY1ZjIyIiwiaWF0IjoxNzUyNzE2NDIwLjQ2MzY1MSwibmJmIjoxNzUyNzE2NDIwLjQ2MzY1NCwiZXhwIjoxNzUyNzIwMDIwLjQ1OTM2NSwic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.xFx8uFFmbSdZmN5Y8N-jrTlmE63s96_ynWAmPowRY5xU2eHLKd_-2S72HK1d9_BuxwEQjf4vxtldfW6motP3uqKQlVrkF85rdGmVvHcY_3rzaBZ0PDRTnn8YjF_8Qa1P22-zMhO0uauca7xRhbSNGvh0K-a3i74lVHOhtO-_x3jgoyIX2Rw6uAXdvSN4XBs6S6m-nGRS5GMD0xe5UVEtxvMbHk5tWxc3S-QsLpmPY3sC_uukh9C2WAdiqoFqDS91hXqRHmK30ST7BZoWYA_yeUHbOdLPT1ZicN0MB7F7uiDSNi-_hCd33GbclV6QYcCCaOu-ZjU9WCihxm9RxpFxYw";
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