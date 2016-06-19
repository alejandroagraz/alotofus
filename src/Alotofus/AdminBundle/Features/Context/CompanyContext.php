<?php

namespace Alotofus\AdminBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext;

/**
 * Feature context.
 */
class CompanyContext extends BehatContext implements KernelAwareInterface
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
    * @Then /^I should see (\d+) companies$/
    */
    public function iShouldSeeCompanies($companies)
    {
        $rows = sizeof($this->getSession()->getPage()->findAll('css', ".companies-table > table > tbody > tr"));
        if ($rows !== intval($companies)) {
            throw new \Exception("The amount of companies is $rows, should be $companies");
        }
    }

    /**
    * @When /^I press "([^"]*)" for "([^"]*)"$/
    */
    public function iPressFor($button, $companyName)
    {
        $row = $this->findRowByCompany($companyName);
        $row->find('css', "td.actions .$button")->click();
    }

    /**
    * @Then /^after waiting, "([^"]*)" must be "([^"]*)"$/
    */
    public function afterWaitingMustBe($companyName, $status)
    {
        $this->getSession()->wait(5000);
        try {
            $row = $this->findRowByCompany($companyName);
        } catch (\Exception $e) {
            if ($status == "hidden") {
                return;
            }
            throw $e;
        }

        switch ($status) {
            case 'activated':
                $icon = $row->find("css", "td.activated > i")->getAttribute("data-icon");
                if ($icon != "true") {
                    throw new \Exception("Activated must be true, got $icon");
                }
                break;
            case 'deactivated':
                $icon = $row->find("css", "td.activated > i")->getAttribute("data-icon");
                if ($icon != "false") {
                    throw new \Exception("Activated must be false, got $icon");
                }
                break;
            default:
                throw new \Exception("Unknown status: $status");
                break;
        }
    }

    /**
    * @Given /^I select all companies$/
    */
    public function iSelectAllCompanies()
    {
        $selector = $this->getSession()->getPage()->find(
            'css',
            ".companies-table > table > thead > tr > th.selector > input"
        );
        if (!$selector) {
            throw new \Exception("Selector for all companies not found");
        }
        $selector->click();
    }

    /**
     * @When /^(?:|I )confirm the popup$/
     */
    public function confirmPopup()
    {
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
    * @Then /^after waiting, I should see (\d+) companies$/
    */
    public function afterWaitingIShouldSeeCompanies($companies)
    {
        $this->getSession()->wait(15000, "$('.companies-table table tbody tr').length === $companies");
        $this->iShouldSeeCompanies($companies);
    }

    /**
     * @param $companyName
     *
     * @return mixed
     * @throws \Exception
     */
    private function findRowByCompany($companyName)
    {
        $rows = $this->getSession()->getPage()->findAll('css', ".companies-table > table > tbody > tr");
        foreach ($rows as $row) {
            $rowName = $row->find('css', 'td.name')->getText();
            if ($rowName == $companyName) {
                return $row;
            }
        }
        throw new \Exception("Company with name $companyName, not found in the table");
    }
}
