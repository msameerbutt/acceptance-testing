<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends DuskTestCase implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param string $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        parent::setUp();
        static::startChromeDriver();
    }

    /**
     * @When I browse following URL :path
     *
     * @param string $path
     * @throws \Exception
     */
    public function iBrowseFollowingUrl(string $path)
    {
        $this->browse(function (Browser $browser) use ($path) {
            $browser->visit($path);
        });
    }

    /**
     * @When I should see this text :text
     *
     * @param string $text
     * @throws \Exception
     */
    public function iShouldSeeThisText(string $text)
    {
        $this->browse(function (Browser $browser) use ($text) {
            $browser->assertSee($text);
        });
    }

    /**
     * @param string $path
     * @return string $path
     * @throws \Exception
     */
    public function getPathUrl(string $path)
    {
        return sprintf('%s%s', env('APP_URL'), $path);
    }
}
