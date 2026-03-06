<?php
namespace App\Site;

class Nasledie4 extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'nasledie4' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/495-fshW1T/house-data/4386';
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