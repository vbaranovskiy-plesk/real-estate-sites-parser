<?php
namespace App\Site;

class ZvezdaCity implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'zvezda.city' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $content = file_get_contents('https://zvezda.city/flats/all');
        preg_match('/<table class="table table-bordered" style="background:#fff; ">(.*?)<\/table>/s', $content, $match);

        if (empty($match)) {
            throw new \Exception('Unable to get content from https://zvezda.city/flats/all');
        }

        $contentType = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $dom = new \DOMDocument();
        $dom->loadHTML($contentType. $match[0]);

        $headers = [];

        $tableHeaders = $dom->getElementsByTagName('tr');
        /** @var \DOMNode $header */

        $rows = $dom->getElementsByTagName("tr");
        $data = [];
        foreach($rows as $row){
            /** @var \DOMNodeList $tds */
            $tds = $row->getElementsByTagName("td");
            if (!$tds->item(0)) {
                continue;
            }

            $roomContent = $tds->item(0)->textContent;
            $data[] = [
                'room_number' => (int)$tds->item(5)->textContent,
                'rooms' => (int)$this->getRoomsCount($roomContent),
                'is_studio' => (int)$roomContent === 'Студия' ? 1 : 0,
                'area' => str_replace('.', ',', trim($tds->item(1)->textContent)),
                'price' => (int)preg_replace("/[^0-9]/", "", $tds->item(2)->textContent),
                'floor' => (int)$tds->item(4)->textContent,
                'section' => (int)$tds->item(8)->textContent,
            ];
        }

        return $data;
    }

    private function getRoomsCount(string $roomTitle): int
    {
        switch ($roomTitle) {
            case 'Студия':
            case '1-комнатная':
                return 1;
            case '2-комнатная':
                return 2;
            case '3-комнатная':
                return 3;
            case '4-комнатная':
                return 4;
            default:
                return 0;
        }
    }
}