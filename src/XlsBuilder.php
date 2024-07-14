<?php
namespace App;
use App\Site\SiteInterface;

class XlsBuilder
{

    public function __construct(private readonly string $prefix)
    {
    }

    public function createXls(SiteInterface $site)
    {
        $columnIds = ['A', 'B', 'C', 'D', 'E', 'F','G', 'H', 'I'];
        $filename = $site->getReportFileName();
        $excel  = new \Vtiful\Kernel\Excel([
            'path' => $this->prefix
        ]);
        $file = $excel->fileName($filename, 'sheet_one');
        $data = $site->getData();
        if (count($data) > 0) {
            $format = new \Vtiful\Kernel\Format($excel->getHandle());
            $firstline = $data[0];
            $columnHeaders = array_keys($firstline);
            $file->header($columnHeaders);
            for ($i = 0; $i < count($columnHeaders); $i++) {
                $file->setColumn($columnIds[$i] . ':' . $columnIds[$i], 20, $format->toResource());
            }
        }
        $file->data($data);
        $file->output();
    }
}