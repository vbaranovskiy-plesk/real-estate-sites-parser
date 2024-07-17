<?php
require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use App\Site\{
    PromDom7,
    ZvezdaCity,
    Biography,
    Koroleva,
    Zaozernyi
};
use App\Report;

$report = new Report([
    new PromDom7(),
    new ZvezdaCity(),
    new Biography(),
    new Koroleva(),
    new Zaozernyi()
]);
$report->make();
echo "Report is done";