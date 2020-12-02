<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        if (! static::runningInSail()) {
            //static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--ignore-certificate-errors',
            '--no-sandbox',
            '--run-all-compositor-stages-before-draw',
            '--whitelisted-ips=""',
            '--window-size=1920,1080',
            '--shm-size=1G',
            '--verbose',
            '--log-path=' . storage_path("logs/chromedriver-errors.log"),
        ]);


        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://selenium:4444/wd/hub',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
