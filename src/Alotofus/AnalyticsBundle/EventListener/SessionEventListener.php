<?php

namespace Alotofus\AnalyticsBundle\EventListener;

use Alotofus\AnalyticsBundle\EntityManager\ActivityAnalyticsManager;
use Alotofus\UserBundle\Event\SubscribeEventInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SessionEventListener
{
    /**
     * @var ActivityAnalyticsManager
     */
    protected $manager;

    protected $cookieToAdd;

    /**
     * Constructor.
     *
     * @param ActivityAnalyticsManager $manager
     */
    public function __construct(ActivityAnalyticsManager $manager)
    {
        $this->manager  = $manager;
        $this->cookieToAdd = null;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onSessionPreInit(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->cookies->get('ALOUSESSID')) {
            $sessionUid = uniqid('', true);
            $this->cookieToAdd = new Cookie('ALOUSESSID', $sessionUid);
            //Hack to store sessionUid on saveActivity()
            $request->cookies->set('ALOUSESSID', $this->cookieToAdd->getValue());
            $this->manager->saveActivity(
                'alotofus.session.init',
                array(
                    $request->headers->get('User-Agent'),
                    $request->headers->get('Accept-Language'),
                    $request->headers->get('Referer')
                ),
                $request
            );
        }
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onSessionPostInit(FilterResponseEvent $event)
    {
        if ($this->cookieToAdd != null) {
            $event->getResponse()->headers->setCookie($this->cookieToAdd);
            $this->cookieToAdd = null;
        }
    }

    /**
     * @param $event
     */
    public function onSessionEnd($event)
    {

    }

    /**
     * @param SubscribeEventInterface $event
     */
    public function onSessionSubscribe(SubscribeEventInterface $event)
    {
        $user = $event->getUser();
        $role = $user->getRoles();
        $param = array($user->getUsername(), $user->getId(), $role[0]);
        $this->manager->saveActivity($event->getName(), $param, $event->getRequest());

    }

    /**
     * @param $event
     */
    public function onSessionLogin($event)
    {

    }

    /**
     * @param $event
     */
    public function onSessionUnsubscribe($event)
    {

    }
}
