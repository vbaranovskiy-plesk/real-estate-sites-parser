<?php
namespace App\Site;

class Nasledie implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'nasledie' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        $objectIds = ['123135'];
        $result = [];
        foreach ($objectIds as $objectId) {
            $result = array_merge($result, $this->getObjectData($objectId));
        }
        return $result;
    }

    private function getObjectData(string $id): array
    {
        //https://www.nasledie42.ru/#/catalog/house/123135/smallGrid?facadeId=56643&filter=property.status:AVAILABLE
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjZkOTE3YTMzM2VmYTZhNzczNTZiYTAyNGFmZDZmMDA4YTMzOGFmZmMwZjRhZTk2MDE4ZTUwYTljNGI3MDlmYmFlNjdiMGYzYjhiZjQyOGVhIiwiaWF0IjoxNzUxMjA0MDg4LjIzMTIzNiwibmJmIjoxNzUxMjA0MDg4LjIzMTIzOSwiZXhwIjoxNzUxMjA3Njg4LjIyNjkzNiwic3ViIjoiU0lURV9XSURHRVR8MjY4MiIsInNjb3BlcyI6WyJTSVRFX1dJREdFVCJdLCJ0eXBlIjoic2l0ZVdpZGdldCIsImVudGl0bGVtZW50cyI6IiIsImFjY291bnQiOnsiaWQiOjExMzA0LCJ0aXRsZSI6ItCe0J7QniDQodCXIFwi0KLQn9ChLdCg0LjRjdC70YJcIiIsInN1YmRvbWFpbiI6InBiMTEzMDQiLCJiaWxsaW5nT3duZXJJZCI6MTEzNDEsImNvdW50cnlDb2RlIjoiUlUifSwicm9sZXMiOlsiUk9MRV9TSVRFX1dJREdFVCJdLCJzaXRlV2lkZ2V0Ijp7ImlkIjoyNjgyLCJkb21haW4iOiJodHRwczovL3d3dy5uYXNsZWRpZTQyLnJ1In19.PpI9VWXDbjomI_AqwpQE1K78cTuPszJp3OKJzYy23wrg59bnfWUPygllIO6Ag2mnlfvHIv2bwWIB5U0Rjrr3g86yZRiffPv0lj7XivMOiU96QTCnSG25LvBizuQa539B_TSDlbZ9thftSLBZazdH63vgnPdUIDlB0_J6BD87t2cVQLTArhQQmv84wdmYRvm_JsHYuyTnPU3ZbeK8Lssa8BMVXVEq3epj1dwouo9NtutC1-PYqel0dAD-Vd4PpiOKFIDfL2lo8rvncl3A3jm5ZTOpLlKbi2gGmcqVtOTSo4ITzdDdyi3gJf3klmyp-zQTztMgqXFLuQg_5AuHYEHgUg";
        $ch = curl_init("https://pb11304.profitbase.ru/api/v4/json/property?houseId=123135&returnFilteredCount=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ $authorization ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
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
                'price' => (string)$flat['price'],
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