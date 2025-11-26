<?php
namespace App\Site;

class Progrand implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'progrand-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $content = file_get_contents('https://www.progrand.ru/estate/index/');
        preg_match('/<table class="table table-condensed table-striped table-hover">(.*?)<\/table>/s', $content, $match);

        if (empty($match)) {
            throw new \Exception('Unable to get content from https://www.progrand.ru/estate/index/');
        }

        $contentType = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $dom = new \DOMDocument();
        $dom->loadHTML($contentType. $match[0]);

        $rows = $dom->getElementsByTagName("tr");
        $data = [];
        $currentProjectName = '';

        foreach($rows as $row){
            /** @var \DOMNodeList $tds */
            $tds = $row->getElementsByTagName("td");

            // Check if this is a project header row (complex-row)
            if ($row->getAttribute('class') === 'complex-row') {
                $h3Elements = $row->getElementsByTagName('h3');
                if ($h3Elements->length > 0) {
                    $currentProjectName = trim($h3Elements->item(0)->textContent);
                }
                continue;
            }

            // Skip header row and rows without enough data
            if (!$tds->item(0) || $tds->length < 6) {
                continue;
            }

            // Extract apartment number from text
            $apartmentText = trim($tds->item(2)->textContent);
            $apartmentNumber = str_replace(['кв.', ' '], '', $apartmentText);

            // Extract area (remove м² and convert comma to dot)
            $areaText = trim($tds->item(3)->textContent);
            $area = str_replace([' м²', '.'], [',', ','], preg_replace('/[^\d\.]/', '', $areaText));

            $data[] = [
                'projectName' => $currentProjectName,
                'rooms' => (int)trim($tds->item(0)->textContent),
                'address' => trim($tds->item(1)->textContent),
                'apartment_number' => $apartmentNumber,
                'area' => $area,
                'floor' => (int)trim($tds->item(4)->textContent),
                'completion_date' => trim($tds->item(5)->textContent)
            ];
        }

        return $data;
    }
}