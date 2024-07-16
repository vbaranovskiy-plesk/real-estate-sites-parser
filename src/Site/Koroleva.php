<?php
namespace App\Site;

class Koroleva implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'koroleva.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['109256', '110477', '113404', '45466', '45467'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        $authorization = "Authorization: Bearer 17fd6d3718ed3dcd6d428e97f8105113147d99c3";
        $ch = curl_init("https://api.realty.cat/api/v1/widget/house/$id?sub_domain=p16");
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