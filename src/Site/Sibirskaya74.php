<?php
namespace App\Site;

class Sibirskaya74 implements SiteInterface
{
    protected function getUrl(): string
    {
        return 'https://tsz.tomsk.ru/objektyi/zhk-sibirskaya-74/';
    }

    public function getReportFileName(): string
    {
        return 'sibirskaya74' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $dom = new \DOMDocument();
        $result = @$dom->loadHTMLFile($this->getUrl());
        if (!$result) {
            throw new \Exception('Unable to get content from https://tsz.tomsk.ru/');
        }

        $xpath = new \DOMXPath($dom);
        $classname = 'grid__wrapper';
        $data = [];
        /** @var \DOMNodeList $nodes */
        $nodes = $xpath->query("//*[contains(@class, '$classname')]");
        /** @var \DOMNode $node */
        $data = [];
        foreach ($nodes as $node) {
            $entrance = 'Неизвестен';
            if ($node->attributes) {
                foreach ($node->attributes as $attribute) {
                    if ($attribute->name === 'data-entrance') {
                        $entrance = $attribute->value;
                        break;
                    }
                }
            }

            /** @var \DOMNode $childNode */
            foreach ($node->childNodes as $childNode) {
                $hasDataFloorAttr = false;
                /** @var  \DOMAttr $attribute */
                if ($childNode->attributes) {
                    foreach ($childNode->attributes as $attribute) {
                        if ($attribute->name === 'data-floor') {
                            $hasDataFloorAttr = true;
                            break;
                        }
                    }
                }
                if (!$hasDataFloorAttr) {
                    continue;
                }
                $s = simplexml_import_dom($childNode);
                $floor = (int)$s->div[0];

                for ($i = 1; $i < 5; $i++) {
                    $status = (string)$s->div[$i]->a->span[0];
                    $area = (string)preg_replace("/[^0-9\,]/", "", trim($s->div[$i]->a->span[1]));
                    $price = (int)preg_replace("/[^0-9]/", "", trim($s->div[$i]->a->span[2]));
                    $rooms = (int)preg_replace("/[^0-9]/", "", trim($s->div[$i]->a->div->span[1]));
                    $roomNumber = (int)preg_replace("/[^0-9]/", "", trim($s->div[$i]->a->div->span[0]));
                    $data[] = [
                        'status' => $status,
                        'room_number' => $roomNumber,
                        'rooms' => $rooms,
                        'area' => $area,
                        'price' => $price,
                        'floor' => $floor,
                        'section' => $entrance
                    ];
                }
            }
        }

        return $data;
    }

}