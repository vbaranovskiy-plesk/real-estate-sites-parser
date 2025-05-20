<?php
namespace App\Site;

class PoeziaParking extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'poezia-parking' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/359-2tXpIm/parking/';
    }

    public function getData(): array
    {
        $content = file_get_contents($this->getUrl());
        $jsonContent = json_decode($content, true);
        $houses = $jsonContent['houses'] ?? [];
        $result = [];
        foreach ($houses as $house) {
            foreach ($house['sections'] as $section) {
                foreach ($section['floors'] as $floor) {
                    foreach ($floor['flats'] as $flat) {
                        $result[] = [
                            'house' => $house['title'] ?? '',
                            'section' => $section['title'] ?? '',
                            'floor' => $floor['number'] ?? '',
                            'number' => $flat['number'] ?? '',
                            'status' => $flat['status'] ?? '',
                            'area' => $flat['area'] ?? '',
                            'price' => $flat['price'] ?? ''
                        ];
                    }
                }
            }
        }
        return $result;
    }
}