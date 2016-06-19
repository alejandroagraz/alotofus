<?php

namespace Alotofus\AdminBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext;

class ListingsContext extends BehatContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
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
     * Get Mink session from MinkContext
     */
    public function getSession($name = null)
    {
        return $this->getMainContext()->getSession($name);
    }

    /**
     * @When /^I click in new resource button$/
     */
    public function iClickInNewResourceButton()
    {
        $button = $this->getSession()->getPage()->find('css', '.create-resource');
        if (!$button) {
            throw new \Exception("Couldn't find create button");
        }
        $button->press();
        //Wait until form is shown
        $this->getSession()->wait(5000, "$('.modal-view').length > 0");
    }

    /**
     * @Then /^after waiting I should see (\d+) resources$/
     */
    public function afterWaitingIShouldSeeResources($resources)
    {
        $this->getSession()->wait(4000, "$('.listing-table tr').length == $resources");
        $this->iShouldSeeResources($resources);
    }

    /**
     * @Given /^I should see (\d+) resources$/
     */
    public function iShouldSeeResources($resources)
    {
        $rows = sizeof($this->getSession()->getPage()->findAll('css', ".listing-table > table > tbody > tr"));
        if ($rows !== intval($resources)) {
            throw new \Exception("The amount of resources is $rows, should be $resources");
        }
    }

    /**
     * @When /^I click in edit resource button for "([^"]*)"$/
     */
    public function iClickInEditResourceButtonFor($name)
    {
        $rows = $this->getSession()->getPage()->findAll('css', ".listing-table > table > tbody > tr");
        foreach ($rows as $row) {
            $rowName = $row->find('css', 'td.name')->getText();
            if ($rowName === $name) {
                $row->find('css', 'td.actions .edit')->click();
                $this->getSession()->wait(5000, "$('.modal-view').length > 0");

                return;
            }
        }
        throw new \Exception("Resource with name $name, not found in the table");
    }
}
