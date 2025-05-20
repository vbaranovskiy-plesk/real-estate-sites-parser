<?php
namespace App\Site;

class Nasledie implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'nasledie' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['123135'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImIwNzU3OTQ3NjZlOGM3MTFkOWI0NTk2MDgwZGEzNjRkNGUzZDE1ZDk5OWZmZWE4YmNmZDc1MmM1ZjA3MDQ5M2ViZmQxY2Q0NGU5YTVlMmVjIiwiaWF0IjoxNzQ3NzYwODU4LjEyODQyNCwibmJmIjoxNzQ3NzYwODU4LjEyODQyNywiZXhwIjoxNzQ3NzY0NDU4LjEyMzQxNCwic3ViIjoiU0lURV9XSURHRVR8MzMxNSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjY4NTgsInRpdGxlIjoi0JDQutCw0LTQtdC80LjRjyIsInN1YmRvbWFpbiI6InBiNjg1OCIsImJpbGxpbmdPd25lcklkIjo2ODk1LCJjb3VudHJ5Q29kZSI6IlJVIn0sInJvbGVzIjpbIlJPTEVfU0lURV9XSURHRVQiXSwic2l0ZVdpZGdldCI6eyJpZCI6MzMxNSwiZG9tYWluIjoiaHR0cHM6Ly94bi0tODBhZXNlZHhvaWcueG4tLXAxYWkifX0.W4DBy1qbAxXPBFLXf18EkB4KQuoLbmRA8Jmc_54Beozaf8IEcmjZlv7__cZukmvxXxAAiTO2FcQqYVO8QUfIpbMlWPrA43UZt2cyWg57iEqhhBG8Ao7nad6b14lu-0WihuxLMwSiYqGnuarO_XDqFn8wNYi6xtj0wMKsPY0tw1za3zKD73dG9zlR9zZFp0O2T-yKt_iTKNce8QpDCTs5FPFmYZvbUzNpqRZMKBs6oqbjsZwLGIrtgwjfdDv9DVqgwTZeBXlDAUheUlKbtYl25ojAGalMtifZ1ucZXqi_uayIGI_5Mr-oXF2J1Bz8J9DZ_pFkW8m-Mtp5m4wGlVr9Zw";
        $ch = curl_init("https://pb11304.profitbase.ru/api/v4/json/property?houseId=123135&returnFilteredCount=true");
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
        var_dump($data);
        die();
        $sections = $data['response']['sections'] ?? [];
        $result = [];
        foreach ($sections as $section) {
            foreach ($section['floors'] as $floor) {
                foreach ($floor['flats'] as $flat) {
                    $result[] = [
                        'number' => $flat['number'],
                        'area' => $flat['area'],
                        'price' => $flat['price'],
                        'price_meter' => $flat['price_meter'],
                        'rooms' => $flat['rooms'],
                        'is_studio' => $flat['is_studio'],
                        'type' => $flat['type'],
                        'section' => $flat['section_name'],
                        'floor' => $flat['floor_number'],
                        'status' => $flat['humanized_status'],
                        'house_name' => $flat['house_name'],
                    ];
                }
            }
        }

        return $result;
    }
}