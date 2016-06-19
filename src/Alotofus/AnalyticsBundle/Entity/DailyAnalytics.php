<?php

namespace Alotofus\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lsa_daily_analytics")
 */
class DailyAnalytics
{
    /**
     * @ORM\Column(name="id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $registeredUsers;

    /**
     * @ORM\Column(type="integer")
     */
    private $activeUsers;

    /**
     * @ORM\Column(type="integer")
     */
    private $enroledUsers;

    /**
     * @ORM\Column(type="integer")
     */
    private $openOffers;

    /**
     * @ORM\Column(type="integer")
     */
    private $registeredCompanies;

    /**
     * @ORM\Column(type="integer")
     */
    private $companiesWithOffers;

    /**
     * @ORM\Column(type="integer")
     */
    private $averageCandidatesPerOffer;

    public function __construct()
    {
        $this->registeredUsers = 0;
        $this->activeUsers = 0;
        $this->openOffers = 0;
        $this->enroledUsers = 0;
        $this->registeredCompanies = 0;
        $this->companiesWithOffers = 0;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param  \DateTime      $date
     * @return DailyAnalytics
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set registeredUsers
     *
     * @param  integer        $registeredUsers
     * @return DailyAnalytics
     */
    public function setRegisteredUsers($registeredUsers)
    {
        $this->registeredUsers = $registeredUsers;

        return $this;
    }

    /**
     * Get registeredUsers
     *
     * @return integer
     */
    public function getRegisteredUsers()
    {
        return $this->registeredUsers;
    }

    /**
     * Set activeUsers
     *
     * @param  integer        $activeUsers
     * @return DailyAnalytics
     */
    public function setActiveUsers($activeUsers)
    {
        $this->activeUsers = $activeUsers;

        return $this;
    }

    /**
     * Get activeUsers
     *
     * @return integer
     */
    public function getActiveUsers()
    {
        return $this->activeUsers;
    }

    /**
     * Set enroledUsers
     *
     * @param  integer        $enroledUsers
     * @return DailyAnalytics
     */
    public function setEnroledUsers($enroledUsers)
    {
        $this->enroledUsers = $enroledUsers;

        return $this;
    }

    /**
     * Get enroledUsers
     *
     * @return integer
     */
    public function getEnroledUsers()
    {
        return $this->enroledUsers;
    }

    /**
     * Set openOffers
     *
     * @param  integer        $openOffers
     * @return DailyAnalytics
     */
    public function setOpenOffers($openOffers)
    {
        $this->openOffers = $openOffers;

        return $this;
    }

    /**
     * Get openOffers
     *
     * @return integer
     */
    public function getOpenOffers()
    {
        return $this->openOffers;
    }

    /**
     * Set registeredCompanies
     *
     * @param  integer        $registeredCompanies
     * @return DailyAnalytics
     */
    public function setRegisteredCompanies($registeredCompanies)
    {
        $this->registeredCompanies = $registeredCompanies;

        return $this;
    }

    /**
     * Get registeredCompanies
     *
     * @return integer
     */
    public function getRegisteredCompanies()
    {
        return $this->registeredCompanies;
    }

    /**
     * Set companiesWithOffers
     *
     * @param  integer        $companiesWithOffers
     * @return DailyAnalytics
     */
    public function setCompaniesWithOffers($companiesWithOffers)
    {
        $this->companiesWithOffers = $companiesWithOffers;

        return $this;
    }

    /**
     * Get companiesWithOffers
     *
     * @return integer
     */
    public function getCompaniesWithOffers()
    {
        return $this->companiesWithOffers;
    }

    /**
     * Set averageCandidatesPerOffer
     *
     * @param  integer        $averageCandidatesPerOffer
     * @return DailyAnalytics
     */
    public function setAverageCandidatesPerOffer($averageCandidatesPerOffer)
    {
        $this->averageCandidatesPerOffer = $averageCandidatesPerOffer;

        return $this;
    }

    /**
     * Get averageCandidatesPerOffer
     *
     * @return integer
     */
    public function getAverageCandidatesPerOffer()
    {
        return $this->averageCandidatesPerOffer;
    }
}
