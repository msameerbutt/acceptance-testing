<?php

namespace Bootstrap;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class LoginContext extends RawMinkContext implements Context
{
    /** @var MinkContext */
    private $minkContext;

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
     * Login as Specific User
     *
     * @param string $email
     * @param string $password
     * @param string $url
     *
     * Example: I login with "email@email.com" and "password" from "/admin/login"
     * @Given I login with <email> and <password> from <url>
     */
    public function iLoginWithAnd(string $email, string $password, string $url)
    {
        $this->minkContext->visit('/admin/login');
        $this->minkContext->fillField('email', $email);
        $this->minkContext->fillField('password', $password);
        $this->minkContext->pressButton('Log in');
    }

    /**
     * Login as Admin User
     * Example: I Login as a Admin user"
     * @Given I Login as a Admin User
     */
    public function iLoginAsAAdminUser()
    {
        $this->iLoginWithAnd(
            'root@adventustesting.io',
            'xxx',
            '/admin/login'
        );
    }

    /**
     * Login as Counsellor User
     * Example: I Login as a Counsellor user"
     * @Given I Login as Counsellor user
     */
    public function iLoginAsACounsellorUser()
    {
        $this->iLoginWithAnd(
            'root@adventustesting.io',
            'xxx',
            '/admin/login'
        );
    }

    /**
     * @When I logout
     */
    public function iLogout()
    {
        $this->getSession()->getPage()->find('css','img.img-avatar')->click();
        $this->getSession()->getPage()->find('css', 'li a i.la-power-off')->click();
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
