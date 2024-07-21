<?php
namespace App\Site;

abstract class DomoPlaner implements SiteInterface
{
    abstract public function getReportFileName(): string;

    abstract public function getUrl(): string;

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
                'metr_price' => $flat['metr_price'],
            ];
        }, $flats);
    }
}