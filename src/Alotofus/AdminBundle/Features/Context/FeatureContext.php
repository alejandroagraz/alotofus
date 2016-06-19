<?php

namespace Alotofus\AdminBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;

use Alotofus\WebBundle\Features\GenericContext\AlotofusContext;

/**
 * Feature context.
 */
class FeatureContext extends AlotofusContext implements KernelAwareInterface
{
    protected $kernel;
    protected $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
        $this->useContext('invitations', new InvitationsContext($parameters));
        $this->useContext('company', new CompanyContext($parameters));
        $this->useContext('listings', new ListingsContext($parameters));
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I wait until list loads$/
     */
    public function iWaitUntilListLoads()
    {
         $this->getSession()->wait(3000);
    }

     /**
    * @When /^I try to access "([^"]*)" admin page$/
    */
    public function iTryToAccessAdminPage($page)
    {
        $this->visit($this->getUrlFromText($page));
    }

    /**
    * @Then /^I should get (\d+) error$/
    */
    public function iShouldGetError($error)
    {
        if (!$this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->assertSession()->statusCodeEquals($error);
        }
        throw new \Exception("Could not check status code");
    }
}
