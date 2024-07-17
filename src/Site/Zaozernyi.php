<?php
namespace App\Site;

class Zaozernyi implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'zaozenrnyi' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $content = file_get_contents('https://domoplaner.ru/widget-api/widget/287-OhYjjj/');
        $jsonContent = json_decode($content, true);
        $flats = $jsonContent['flats'] ?? [];
        return array_map(function ($flat) {
            return [
                'area' => $flat['area'],
                'number' => $flat['number'],
                'is_studio' => $flat['is_studio'],
                'price' => $flat['price'],
                'price_with_discount' => $flat['price_with_discount'],
                'rooms' => $flat['rooms'],
                'house_title' => $flat['house_title'],
                'floor_number' => $flat['floor_number'],
                'metr_price' => $flat['metr_price'],
            ];
        }, $flats);
    }
}