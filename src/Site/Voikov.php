<?php
namespace App\Site;

class Voikov implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'voikov' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['130502'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        //https://voikov.com/#/catalog/house/130502/smallGrid?filter=property.status:AVAILABLE
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6ImQ3YzExZDkxYmM2NjljMDY1ZGUyMzk3ZDg2Y2E3ZTE0ZGI1MWU2YjRmNmU2NjhiZmZlOGE4MTE1NzU3NmI0NTU3YzM3NzFmYTdkNWNhMjZlIiwiaWF0IjoxNzUxMjA0Mjg2LjY0MjA3MiwibmJmIjoxNzUxMjA0Mjg2LjY0MjA3NCwiZXhwIjoxNzUxMjA3ODg2LjYzNjkwMiwic3ViIjoiU0lURV9XSURHRVR8MjI1NSIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjE0MjgwLCJ0aXRsZSI6ItCS0L7QudC60L7QsiIsInN1YmRvbWFpbiI6InBiMTQyODAiLCJiaWxsaW5nT3duZXJJZCI6MTQzMTcsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyMjU1LCJkb21haW4iOiJodHRwczovL3ZvaWtvdi5jb20ifX0.2CvoW9rRDC9wJ6Py5JjxBVy5-SCnSQIivMYCdNqCXeTM9tcxtcNiise5_w-at5uDQIyD9Zb6KEC8pOua_F1QipkgIL9GV4rr_81ouzkkw61wjSkt_jF6hxbGuJqlIzKhPDlQeYs-oV5bBaVqbRfDDVI_i5tbdi4ocQNh8PEnDMJxA9Nah1tifVt98TDek1t2ldvZOrrDLPBpEl3O5KMmbElhsDFR_C319aQhtsP0lxNOjpFIf98qhor5nzPqYuM-TxhyKDJ17wrtQbmqcZB9-iqjSgQwuVBZOCKT1G1gWYGWHAiYSTHN3Wg5Eu3zLPZBBdVLfJhWXzzJGNOIFMADqA";
        $ch = curl_init("https://pb14280.profitbase.ru/api/v4/json/property?houseId=130502&returnFilteredCount=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$authorization]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $curlResult = curl_exec($ch);
        if (!$curlResult) {
            throw new \Exception('Unable to get info about koroleva estate: ' . curl_error($ch));
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
                'price' => '',
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