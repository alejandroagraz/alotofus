<?php

namespace Alotofus\AnalyticsBundle\EntityManager;

use Alotofus\AnalyticsBundle\Entity\DailyAnalytics;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

class DailyAnalyticsManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em  = $em;
    }

    /**
     * @param int $days
     *
     * @return array
     */
    public function findLastDays($days = 30)
    {
        $dql = "SELECT da
                FROM AlotofusAnalyticsBundle:DailyAnalytics da
                WHERE da.date > :days ORDER BY da.date ASC";

        $query = $this->em->createQuery($dql)
            ->setParameter('days', new \DateTime("-$days days"));

        return $query->getResult();
    }

    /**
     * @return DailyAnalytics|null
     */
    public function fetchAndSave()
    {
        $dailyAnalytics =  null;
        try {
            $dailyAnalytics = $this->em->getRepository('AlotofusAnalyticsBundle:DailyAnalytics')
                ->findOneByDate(new \DateTime());
        } catch (NoResultException $e) {
        }

        if (!$dailyAnalytics) {
            $dailyAnalytics = new DailyAnalytics();
        }

        $dailyAnalytics->setDate(new \DateTime());
        $dailyAnalytics->setRegisteredUsers($this->fetchRegisteredUsers());
        $dailyAnalytics->setActiveUsers($this->fetchActiveUsers());
        $dailyAnalytics->setEnroledUsers($this->fetchEnroledUsers());
        $dailyAnalytics->setOpenOffers($this->fetchOpenOffers());
        $dailyAnalytics->setRegisteredCompanies($this->fetchRegisteredCompanies());
        $dailyAnalytics->setCompaniesWithOffers($this->fetchCompaniesWithOffers());
        $dailyAnalytics->setAverageCandidatesPerOffer($this->fetchAverageCandidatesPerOffer());

        $this->em->persist($dailyAnalytics);
        $this->em->flush();

        return $dailyAnalytics;

    }

    /**
     * @return mixed
     */
    public function fetchRegisteredUsers()
    {
        $dql = "SELECT Count(u.id) FROM AlotofusUserBundle:User u";

        $query = $this->em->createQuery($dql);

        return $query->getSingleScalarResult();
    }

    /**
     * @return mixed
     */
    public function fetchActiveUsers()
    {
        $dql = "SELECT Count(u.id)
                FROM AlotofusUserBundle:User u
                WHERE u.lastLogin > :lastWeek";

        $query = $this->em->createQuery($dql)
                ->setParameter('lastWeek', new \Datetime('-1 week'));

        return $query->getSingleScalarResult();
    }

    /**
     * @return int
     */
    public function fetchEnroledUsers()
    {
        return -1;
    }

    /**
     * @return mixed
     */
    public function fetchOpenOffers()
    {
        $dql = "SELECT Count(j.id)
                FROM AlotofusJobOffersBundle:JobOffer j
                WHERE j.publishDate IS NOT null AND j.offerEnds > :now";

        $query = $this->em->createQuery($dql)
            ->setParameter('now', new \Datetime('now'));

        return $query->getSingleScalarResult();
    }

    /**
     * @return mixed
     */
    public function fetchRegisteredCompanies()
    {
        $dql = "SELECT Count(c.id)
                FROM AlotofusCompanyBundle:Company c
                WHERE c.activated = true";

        $query = $this->em->createQuery($dql);

        return $query->getSingleScalarResult();
    }

    /**
     * @return mixed
     */
    public function fetchCompaniesWithOffers()
    {
        $dql = "SELECT COUNT(DISTINCT c.id)
                FROM AlotofusJobOffersBundle:JobOffer j
                JOIN j.company c
                WHERE j.publishDate IS NOT null AND j.offerEnds > :now";

        $query = $this->em->createQuery($dql)
            ->setParameter('now', new \Datetime('now'));

        return $query->getSingleScalarResult();
    }

    /**
     * @return int
     */
    public function fetchAverageCandidatesPerOffer()
    {
        return -1;
    }
}
