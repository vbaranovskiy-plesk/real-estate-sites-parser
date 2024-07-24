<?php
require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use App\Site\{
    PromDom7,
    ZvezdaCity,
    Biography,
    Koroleva,
    Zaozernyi,
    ArkadiaIvanova,
    Sibirskaya74,
    Sibirskaya84,
};
use App\Report;

$report = new Report([
    new PromDom7(),
    new ZvezdaCity(),
    new Biography(),
    new Koroleva(),
    new Zaozernyi(),
    new ArkadiaIvanova(),
    new Sibirskaya74(),
    new Sibirskaya84(),
]);
$report->make();
echo "Report is done";