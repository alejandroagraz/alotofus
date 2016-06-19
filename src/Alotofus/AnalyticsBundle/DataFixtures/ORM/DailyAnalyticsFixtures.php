<?php

namespace Alotofus\AnalyticsBundle\DataFixtures\ORM;

use Alotofus\AnalyticsBundle\Entity\DailyAnalytics;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DailyAnalyticsFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime("40 days ago");
        $previous = new DailyAnalytics();
        for ($i = 0; $i < 40; $i++) {
            $dailyAnalytics = new DailyAnalytics();
            $dailyAnalytics->setDate(new \DateTime($date->format('Y-m-d')));
            $dailyAnalytics->setRegisteredUsers(
                rand($previous->getRegisteredCompanies(), $previous->getRegisteredCompanies() + 50)
            );
            $dailyAnalytics->setActiveUsers(
                rand($previous->getActiveUsers(), $previous->getActiveUsers() + 50)
            );
            $dailyAnalytics->setEnroledUsers(
                rand($previous->getEnroledUsers(), $previous->getEnroledUsers() + 50)
            );
            $dailyAnalytics->setOpenOffers(
                rand($previous->getOpenOffers(), $previous->getOpenOffers() + 50)
            );
            $dailyAnalytics->setRegisteredCompanies(
                rand($previous->getRegisteredCompanies(), $previous->getRegisteredCompanies() + 50)
            );
            $dailyAnalytics->setCompaniesWithOffers(
                rand($previous->getCompaniesWithOffers(), $previous->getCompaniesWithOffers() + 50)
            );
            $dailyAnalytics->setAverageCandidatesPerOffer(
                rand($previous->getAverageCandidatesPerOffer(), $previous->getAverageCandidatesPerOffer() + 50)
            );

            $manager->persist($dailyAnalytics);

            $previous = $dailyAnalytics;
            $date->add(new \DateInterval("P1D"));
        }
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
