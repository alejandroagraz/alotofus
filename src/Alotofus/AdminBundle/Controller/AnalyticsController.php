<?php

namespace Alotofus\AdminBundle\Controller;

use Alotofus\AnalyticsBundle\Entity\DailyAnalytics;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnalyticsController extends Controller
{
    /**
     * @param int $days
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($days = 30)
    {
        $analytics = $this->get('alotofus_analytics.manager.daily')->findLastDays($days);
        $currDate = new \DateTime("$days days ago");
        $dates = array();
        $parsed = array();
        for ($i = 30; $i >= 0; $i--) {
            $day = new \DateTime("$i days ago");
            $dates[] = $day->format('d/m');
        }
        /** @var $an DailyAnalytics */
        foreach ($analytics as $an) {
            while ($an->getDate()->format('Y-m-d') != $currDate->format('Y-m-d')) {
                $parsed = $this->fillAnalyticsArray(new DailyAnalytics(), $parsed);
                $currDate->add(new \DateInterval("P1D"));
            }
            $currDate->add(new \DateInterval("P1D"));
            $parsed = $this->fillAnalyticsArray($an, $parsed);
        }

        return $this->render('AlotofusAdminBundle:Analytics:index.html.twig', array(
            'parsedAnalytics' => $parsed,
            'dates' => $dates,
            'firstAnalytic' => $analytics[0],
            'lastAnalytic' => $analytics[sizeof($analytics) - 1]
        ));
    }

    /**
     * @param DailyAnalytics $analytic
     * @param                $parsed
     *
     * @return mixed
     */
    private function fillAnalyticsArray(DailyAnalytics $analytic, $parsed)
    {
        $parsed['registeredUsers'][] = $analytic->getRegisteredUsers();
        $parsed['activeUsers'][] = $analytic->getActiveUsers();
        $parsed['openOffers'][] = $analytic->getOpenOffers();
        $parsed['enroledUsers'][] = $analytic->getEnroledUsers();
        $parsed['registeredCompanies'][] = $analytic->getRegisteredCompanies();
        $parsed['companiesWithOffers'][] = $analytic->getCompaniesWithOffers();

        return $parsed;
    }
}
