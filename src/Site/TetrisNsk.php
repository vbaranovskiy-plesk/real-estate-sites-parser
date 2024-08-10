<?php
namespace App\Site;

class TetrisNsk extends DomoPlaner implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'tetris-nsk' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getUrl(): string
    {
        return 'https://domoplaner.ru/widget-api/widget/421-YwCRNv/';
    }

    public function getData(): array
    {
        $content = file_get_contents($this->getUrl());
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
            ];
        }, $flats);
    }
}