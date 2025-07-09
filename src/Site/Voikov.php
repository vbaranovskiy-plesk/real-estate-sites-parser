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
        $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJzaXRlX3dpZGdldCIsImp0aSI6IjFlMzBjOTM5NWY0ZmNlZjkxYzQ3YjY0NjM3YzZkY2IxZDhkZWZmZjQ1YzFiYjQzNDM1YTFmNDNlOWI0MGU5MDVkZjk1OTljZmIzNThiOGNhIiwiaWF0IjoxNzUyMDI4NjQ1LjQwNzU0NSwibmJmIjoxNzUyMDI4NjQ1LjQwNzU0OCwiZXhwIjoxNzUyMDMyMjQ1LjQwMzQ3LCJzdWIiOiJTSVRFX1dJREdFVHwyMjU1Iiwic2NvcGVzIjpbIlNJVEVfV0lER0VUIl0sInR5cGUiOiJzaXRlV2lkZ2V0IiwiZW50aXRsZW1lbnRzIjoiIiwiYWNjb3VudCI6eyJpZCI6MTQyODAsInRpdGxlIjoi0JLQvtC50LrQvtCyIiwic3ViZG9tYWluIjoicGIxNDI4MCIsImJpbGxpbmdPd25lcklkIjoxNDMxNywiY291bnRyeUNvZGUiOiJSVSJ9LCJyb2xlcyI6WyJST0xFX1NJVEVfV0lER0VUIl0sInNpdGVXaWRnZXQiOnsiaWQiOjIyNTUsImRvbWFpbiI6Imh0dHBzOi8vdm9pa292LmNvbSJ9fQ.RwbD0SrmdAlluV-EX2kfi2KISbTpHBnEfDIwwgo6ZeMisktSsFbPr_Seu4ghW0y5g4Aul6dvD3ijQ6rnoR82G6ZnfeI6Zvzv4SHxRF0iqfPyT1s0h5gdArrGov7wOaKSRLRLUJf8DwPE0H-EzmPVY7mD44gRKMTTLMVmllUI3c6A6q7HiNnQewp9KblKYAOf86F_uhEQJJsjQkI2SdcdQMkfgpPVeK4egnabnLNDNjGI2mgPIAand-k_gvTLK-3VfSD_oaz2OcgKaLo9bGXLp6FblPsxfKxAT7oejyU6XXUDkEVgf1HvA9Lte1u4hS8WPB_zozjzGmFX1SQ3MszEgA";
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