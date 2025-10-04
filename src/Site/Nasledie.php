<?php
namespace App\Site;

class Nasledie extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'nasledie' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/495-fshW1T/house-data/4201';
    }

    public function getData(): array
    {
        $content = file_get_contents($this->getUrl());
        $jsonContent = json_decode($content, true);
        $house = $jsonContent['house'] ?? null;
        $result = [];
        if (is_null($house)) {
            return $result;
        }
        foreach ($house['sections'] as $section) {
            foreach ($section['floors'] as $floor) {
                foreach ($floor['flats'] as $flat) {
                    $result[] = [
                        'house' => $house['title'] ?? '',
                        'section' => $section['title'] ?? '',
                        'floor' => $flat['floor_number'] ?? '',
                        'is_studio' => $flat['is_studio'] ?? '',
                        'number' => $flat['number'] ?? '',
                        'status' => $flat['status'] ?? '',
                        'area' => $flat['area'] ?? '',
                        'price' => $flat['price'] ?? ''
                    ];
                }
            }
        }

        return $result;
    }
/*
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
        //https://www.nasledie42.ru/#/catalog/house/123135/smallGrid?facadeId=56643&filter=property.status:AVAILABLE
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjZlYzEyMGQ5OTA2YmU2NWJhNmQxN2MwMWEyOWVlYWYwMDk0M2ZiOGM3MTRlZjNmODMyNmQ0OWU1NDMzMzY3NzFiNmRiMmE0N2E0MTI3N2ZjIiwiaWF0IjoxNzUyMDI4Njg1Ljc3NzkxNiwibmJmIjoxNzUyMDI4Njg1Ljc3NzkxOCwiZXhwIjoxNzUyMDMyMjg1Ljc2NTk5NSwic3ViIjoiU0lURV9XSURHRVR8MjY4MiIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjExMzA0LCJ0aXRsZSI6ItCe0J7QniDQodCXIFwi0KLQn9ChLdCg0LjRjdC70YJcIiIsInN1YmRvbWFpbiI6InBiMTEzMDQiLCJiaWxsaW5nT3duZXJJZCI6MTEzNDEsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyNjgyLCJkb21haW4iOiJodHRwczovL3d3dy5uYXNsZWRpZTQyLnJ1In19.iQRufyibI6mAk-luQBQVzkjbLJsnr8kK8XxdReLkNLwGLBLhci0soXvYe3e2GCDTVquIsJfgjtq7MsT7AHZhV-22uwmIRSwQl9BScRocO2fR9YTz6gLIt8vuEjrXT-JE_PVHQ3Z3PC18G7yF5NF9zLYmpWdY1q045ztqTC_H9Oz51axq0tgaa9FI4S8TRysexgjni07FHggeFtHKshPkDlGHUvwjEoMUIOMzv5FgwkTGg3NFu3dfXxtXfsco30NK9e7g-nEQcZ5eBQ_QPg5DrZFIdxpmsOSiQcp_HfSS93fnAqXNQ-6hpJbCSFk6IjUnksvaapygqqULCbLDwYMY9w";
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
*/
}