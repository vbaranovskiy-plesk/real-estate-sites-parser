<?php
namespace App\Site;

class Voikov implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'voikov' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['130502'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImM2ZTExZjk2YWQ2Y2VlZmVjOGMzZWMzYzEzODE0NWQ0ZjdlNWEyYjA5MWNkYWIzMjcwOTU5ZWEwYTg2YTM5OTM2YTM3MTBkMTAzYjgwOTA0IiwiaWF0IjoxNzQ3NzYyNDAzLjMwNzM0OSwibmJmIjoxNzQ3NzYyNDAzLjMwNzM1MywiZXhwIjoxNzQ3NzY2MDAzLjMwMTM5OCwic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.b6yr78yGVjTx4xMpB-mmsHv8HI587gneOL6mg6wu-5Fe0Ke7wKeCn43j3U0JZI3g6yAOVMVNV-CTO9x4exoHkSqiVGni4P7l4vR2OXWeqZbG90_bkpK2rxouu9Bk3Btru5a0H7-ru3X3lljtpniCFuG2KxQXX3vJbmMivKGXiepRW5crAEdgIhymTKQ2xR1a-4ozTFCHW75eChk-5ojV2kRZurahIsT8duYxdhAbVr5BzemCMaaF7fRkhO5v7AzUI8lnuU3YpchfDcgyx57VNcmZ1qpbUpGx9XUSgMD9rFcCIFLxeMmbNhNxPmUPF5GCBCFuCYP26SvenAIbT-_DGg";
        $ch = curl_init("https://pb14280.profitbase.ru/api/v4/json/property?houseId=130502&returnFilteredCount=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$authorization]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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