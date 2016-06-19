<?php

namespace Alotofus\AdminBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext;

/**
 * Feature context.
 */
class InvitationsContext extends BehatContext implements KernelAwareInterface
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
     * @Then /^I should see (\d+) candidates$/
     */
    public function iShouldSeeCandidates($candidates)
    {
        $rows = sizeof($this->getSession()->getPage()->findAll('css', ".invitations-table > table > tbody > tr"));
        if ($rows !== intval($candidates)) {
            throw new \Exception("The amount of candidates is $rows, should be $candidates");
        }
    }

    /**
     * @When /^I click in send invitation for candidate "([^"]*)"$/
     */
    public function iClickInSendInvitationForCandidate($name)
    {
        $rows = $this->getSession()->getPage()->findAll('css', ".invitations-table > table > tbody > tr");
        foreach ($rows as $row) {
            $rowName = $row->find('css', 'td.name')->getText();
            if ($rowName === $name) {
                $row->find('css', 'td.actions .send-invitation')->click();

                return;
            }
        }
        throw new \Exception("Candidate with name $name, not found in the table");

    }

    /**
     * @Then /^after waiting I should see (\d+) candidates$/
     */
    public function afterWaitingIShouldSeeCandidates($candidates)
    {
        $this->getSession()->wait(5000);
        $this->iShouldSeeCandidates($candidates);
    }

    /**
     * @When /^I select all candidates$/
     */
    public function iSelectAllCandidates()
    {
        $selector = $this->getSession()->getPage()->find(
            'css',
            ".invitations-table > table > thead > tr > th.selector > input"
        );
        if (!$selector) {
            throw new \Exception("Selector for all candidates not found");
        }
        $selector->click();
    }

    /**
     * @Given /^I click in general send invitation button$/
     */
    public function iClickInGeneralSendInvitationButton()
    {
        $sendButton = $this->getSession()->getPage()->find('css', ".invitations-table .send-invitations");
        if (!$sendButton) {
            throw new \Exception("Send invitation button not found");
        }
        $sendButton->click();
    }
}
