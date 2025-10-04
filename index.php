<?php
require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use App\Site\{
    PromDom7,
    Biography,
    Koroleva,
    Zaozernyi,
    ArkadiaIvanova,
    Sibirskaya74,
    Sibirskaya84,
    Kvartal1604,
    Kvartal1604Pantries,
    TetrisNsk,
    PoeziaHouse,
    PoeziaParking,
    TrendAgent,
    ZvezdaCityDm2552,
    ZvezdaCityDm3887,
    Avtorskiy,
    Nasledie,
    Voikov
};
use App\Report;


use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Chrome\ChromeOptions;

$report = new Report([
    new PromDom7(),
    new Biography(),
    new Koroleva(),
    new Zaozernyi(),
    new ArkadiaIvanova(),
    new Sibirskaya74(),
    new Sibirskaya84(),
    new Kvartal1604(),
    new Kvartal1604Pantries(),
    new TetrisNsk(),
    new PoeziaHouse(),
    new PoeziaParking(),
    new ZvezdaCityDm2552(),
    new ZvezdaCityDm3887(),
    new Avtorskiy(),
    new Nasledie(),
    new Voikov()
]);
$report->make();

/*
$seleniumHubUrl = 'http://localhost:4444/wd/hub';  // ✅ Correct

$options = new Facebook\WebDriver\Chrome\ChromeOptions();
$options->addArguments(['--disable-gpu', '--no-sandbox', '--headless']);  // ✅ Fix options

$capabilities = Facebook\WebDriver\Remote\DesiredCapabilities::chrome();
$capabilities->setCapability(Facebook\WebDriver\Chrome\ChromeOptions::CAPABILITY, $options);

try {
    $driver = Facebook\WebDriver\Remote\RemoteWebDriver::create($seleniumHubUrl, $capabilities);
    $driver->get('https://odinitri.ru/kvartiry/?view=rows&set_filter=y&arrFilterApartments_53_MIN=5813174&arrFilterApartments_53_MAX=11725850&arrFilterApartments_44_MIN=31&arrFilterApartments_44_MAX=79&arrFilterApartments_43_MIN=1&arrFilterApartments_43_MAX=10');

    echo "Page Title: " . $driver->getTitle();
    $wait = new WebDriverWait($driver, 10); // Wait for a maximum of 10 seconds
    /** @var Facebook\WebDriver\Remote\RemoteWebElement $element */
   /* $element = $wait->until(
        WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('apartments')) // Replace with your element's locator
    );

    echo $element->getText();
    $driver->quit();
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
*/
   echo "Report is done";