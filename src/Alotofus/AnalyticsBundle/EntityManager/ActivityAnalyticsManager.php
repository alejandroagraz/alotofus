<?php

namespace Alotofus\AnalyticsBundle\EntityManager;

use Alotofus\AnalyticsBundle\Entity\ActivityAnalytics;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class ActivityAnalyticsManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var
     */
    protected $securityContext;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     * @param               $securityContext
     */
    public function __construct(EntityManager $em, $securityContext)
    {
        $this->em  = $em;
        $this->securityContext = $securityContext;
    }

    /**
     * @param         $name
     * @param         $params
     * @param Request $request
     */
    public function saveActivity($name, $params, Request $request)
    {
        $activity = new ActivityAnalytics();
        $activity->setActivity($name);

        $user = $this->securityContext->getToken()->getUser();
        if ($user instanceof AdvancedUserInterface) {
            $role = $user->getRoles();
            $activity->setRole($role[0]);
            $activity->setUserId($user->getId());
        }

        $activity->setIp($request->getClientIp());
        $activity->setSessionId($request->cookies->get('ALOUSESSID'));
        $activity->setDatetime(new \Datetime());
        $activity->setParam0(isset($params[0])?$params[0]:null);
        $activity->setParam1(isset($params[1])?$params[1]:null);
        $activity->setParam2(isset($params[2])?$params[2]:null);
        $activity->setParam3(isset($params[3])?$params[3]:null);
        $activity->setParam4(isset($params[4])?$params[4]:null);
        $activity->setParam5(isset($params[5])?$params[5]:null);
        $activity->setParam6(isset($params[6])?$params[6]:null);
        $activity->setParam7(isset($params[7])?$params[7]:null);
        $activity->setParam8(isset($params[8])?$params[8]:null);
        $activity->setParam9(isset($params[9])?$params[9]:null);
        $activity->setParam10(isset($params[10])?$params[10]:null);

        $this->em->persist($activity);
        $this->em->flush();
    }
}
