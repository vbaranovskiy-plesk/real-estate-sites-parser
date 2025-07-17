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
        //https://voikov.com/#/catalog/house/130502/smallGrid?filter=property.status:AVAILABLE
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjlkZGVkZDNjYTJjN2Q2M2U2MzYwZjJlMjU0Njg0NzVlMmY1MDNiNzQ5YWViNWJiODI1NzM2YWU2NzNhNzQ4NjliYzY2MGU4ZjQxYWZjOTQ1IiwiaWF0IjoxNzUyNzE2NjQxLjc0MTIyMywibmJmIjoxNzUyNzE2NjQxLjc0MTIyNSwiZXhwIjoxNzUyNzIwMjQxLjczNTY5OSwic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.uiH-81pNWSjbj5dAvtv2OL-cHMqYz4U1D8aOhKVqy4e8kL2baCFRWGDxpKq0YRUIDnaAJcKCgmV_9bQGfL38yzknuOWVSABMquMme6aXDPvvuDKnEJKulaTTgjZGIbHmaIViEpK7RoZmTp0xOUh64q8XK25x-tHKUNVGFHlDXglNcN4pvC-K4k9DAEWvN11fnHyu4DzntHevfBc_De_okhouLhuJOsfj-9iM9zUaYCu4Z1v-WcXbxuLaKxVfJ3hu5irmuADUuItCmd6nbYx-I4USRZrRuiiSAmU9M2y33RyR2lUoQWusG-_qdCd3wHGWilyNPs0JD37WQq_owei_rw";
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
        $result = [];
        foreach ($data['data']['properties'] as $flat) {
            if (!$flat['number']) {
                continue;
            }
            $result[] = [
                'number' => $flat['number'],
                'area' => $flat['area']['area_total'],
                'price' => '',
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