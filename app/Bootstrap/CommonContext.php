<?php

namespace Bootstrap;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Bootstrap\Model\Model;
use Bootstrap\Model\ModelFactory;

/**
 * Defines application features from the specific context.
 */
class CommonContext extends RawMinkContext implements Context
{
    /** @var MinkContext */
    private $minkContext;

    /** @var array */
    private $data;

    /**
     * This function will be executed before each scenario
     *
     * @BeforeScenario
     * @param BeforeScenarioScope $scope
     *
     */
    public function beforeEachScenario(BeforeScenarioScope $scope)
    {
        /** @var InitializedContextEnvironment $environment */
        $environment = $scope->getEnvironment();
        # Get all the contexts you need in this context
        $this->minkContext = $environment->getContext(MinkContext::class);
    }

    /**
     * Take screenshot of the page
     * Example: When I took a screenshot"
     * @When I took a screenshot
     */
    public function iTookAScreenshot()
    {
        $this->saveScreenshot(null , '/var/www/html/Screenshots');
    }

    /**
     * See the words from the table
     * @param string $lookingFor
     * @param string $modelName
     * @param TableNode $table
     * @Given I should see column :lookingFor for :modelName page
     * @throws \Exception
     */
    public function iShouldSeeFor(string $lookingFor, string $modelName, TableNode $table)
    {
        /** @var Model $model */
        $model = ModelFactory::createModel($this->minkContext, $modelName);
        $callable = strtolower($lookingFor);
        if (!method_exists($model, $callable)) {
            throw new \Exception(sprintf('Unknown method:%s for model:%s', $callable, $modelName));
        }

        foreach ($table as $row) {
            $model->$callable($row[$lookingFor]);
            switch ($model) {
                case "Tenant Tabs":
                    $this->minkContext->assertPageContainsText($row['Tabs']);
                    break;
            }
        }
    }

    /**
     * Add record to a specific model
     * @param string $modelName
     * @param TableNode $table
     * @Given I add :modelName from Table:
     * @throws \Exception
     */
    public function iAddFromTable(string $modelName, TableNode $table)
    {
        /** @var Model $model */
        $model = ModelFactory::createModel($this->minkContext, $modelName);
        foreach ($table as $row) {
            if (!empty($this->data[$modelName][$row[$modelName]])) {
                $model->add($this->data[$modelName][$row[$modelName]]);
            }
        }
    }

    /**
     * Read Data from file
     * @param string $modelName
     * @param string $filepath
     *
     * Example: And I am using "Tenant" data from "Core/Tenant.yml"
     * @Given I am using :modelName data from :filepath
     */
    public function iAmUsingDataFrom(string $modelName, string $filepath)
    {
        $this->data[$modelName] = \yaml_parse_file($filepath);
    }

    /**
     * This function will be executed after each scenario
     * @AfterScenario
     *
     * @param AfterScenarioScope $scope
     */
    public function afterEachScenario(AfterScenarioScope $scope)
    {

    }
}
