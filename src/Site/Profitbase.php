<?php
namespace App\Site;

use Exception;

abstract class Profitbase implements SiteInterface
{
    abstract public function getReportFileName(): string;

    abstract protected function getSubdomain(): string;

    abstract protected function getHouseIds(): array;

    abstract protected function getSiteUrl(): string;

    abstract protected function getAuthToken(): string;

    public function getData(): array
    {
        $result = [];
        foreach ($this->getHouseIds() as $houseId) {
            $result = array_merge($result, $this->getObjectData($houseId));
        }
        return $result;
    }

    private function getObjectData(string $houseId): array
    {
        $token = $this->getAuthToken();
        $authorization = "Authorization: Bearer " . $token;
        $subdomain = $this->getSubdomain();

        $ch = curl_init("https://{$subdomain}.profitbase.ru/api/v4/json/property?houseId={$houseId}&returnFilteredCount=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$authorization]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $curlResult = curl_exec($ch);
        if (!$curlResult) {
            throw new Exception('Unable to get info about ' . $this->getReportFileName() . ' estate: ' . curl_error($ch));
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
                'price' => is_array($flat['price']) ? (string)($flat['price']['value'] ?? $flat['price']['total'] ?? '') : (string)($flat['price'] ?? ''),
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