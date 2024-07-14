<?php
require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use App\Site\PromDom7;
use App\Report;

$report = new Report([new PromDom7()]);
$report->make();
echo "Report is done";