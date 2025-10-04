<?php
namespace App\Site;

class ZvezdaCityDm2552 extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'zvezda-city-2552' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/413-65FOme/house-data/2552';
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
}