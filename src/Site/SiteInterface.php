<?php
namespace App\Site;

interface SiteInterface
{
    public function getData(): array;

    public function getReportFileName(): string;
}