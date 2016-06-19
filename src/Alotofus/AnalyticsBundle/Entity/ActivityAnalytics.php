<?php

namespace Alotofus\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lsa_activity_analytics")
 */
class ActivityAnalytics
{
    /**
     * @ORM\Column(name="id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $sessionId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $activity;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param0;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param2;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param3;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param4;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param5;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param6;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param7;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param8;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param9;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $param10;

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param  string            $role
     * @return ActivityAnalytics
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set userId
     *
     * @param  string            $userId
     * @return ActivityAnalytics
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ip
     *
     * @param  string            $ip
     * @return ActivityAnalytics
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set sessionId
     *
     * @param  string            $sessionId
     * @return ActivityAnalytics
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set datetime
     *
     * @param  \DateTime         $datetime
     * @return ActivityAnalytics
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set activity
     *
     * @param  string            $activity
     * @return ActivityAnalytics
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set param0
     *
     * @param  string            $param0
     * @return ActivityAnalytics
     */
    public function setParam0($param0)
    {
        $this->param0 = $param0;

        return $this;
    }

    /**
     * Get param0
     *
     * @return string
     */
    public function getParam0()
    {
        return $this->param0;
    }

    /**
     * Set param1
     *
     * @param  string            $param1
     * @return ActivityAnalytics
     */
    public function setParam1($param1)
    {
        $this->param1 = $param1;

        return $this;
    }

    /**
     * Get param1
     *
     * @return string
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * Set param2
     *
     * @param  string            $param2
     * @return ActivityAnalytics
     */
    public function setParam2($param2)
    {
        $this->param2 = $param2;

        return $this;
    }

    /**
     * Get param2
     *
     * @return string
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * Set param3
     *
     * @param  string            $param3
     * @return ActivityAnalytics
     */
    public function setParam3($param3)
    {
        $this->param3 = $param3;

        return $this;
    }

    /**
     * Get param3
     *
     * @return string
     */
    public function getParam3()
    {
        return $this->param3;
    }

    /**
     * Set param4
     *
     * @param  string            $param4
     * @return ActivityAnalytics
     */
    public function setParam4($param4)
    {
        $this->param4 = $param4;

        return $this;
    }

    /**
     * Get param4
     *
     * @return string
     */
    public function getParam4()
    {
        return $this->param4;
    }

    /**
     * Set param5
     *
     * @param  string            $param5
     * @return ActivityAnalytics
     */
    public function setParam5($param5)
    {
        $this->param5 = $param5;

        return $this;
    }

    /**
     * Get param5
     *
     * @return string
     */
    public function getParam5()
    {
        return $this->param5;
    }

    /**
     * Set param6
     *
     * @param  string            $param6
     * @return ActivityAnalytics
     */
    public function setParam6($param6)
    {
        $this->param6 = $param6;

        return $this;
    }

    /**
     * Get param6
     *
     * @return string
     */
    public function getParam6()
    {
        return $this->param6;
    }

    /**
     * Set param7
     *
     * @param  string            $param7
     * @return ActivityAnalytics
     */
    public function setParam7($param7)
    {
        $this->param7 = $param7;

        return $this;
    }

    /**
     * Get param7
     *
     * @return string
     */
    public function getParam7()
    {
        return $this->param7;
    }

    /**
     * Set param8
     *
     * @param  string            $param8
     * @return ActivityAnalytics
     */
    public function setParam8($param8)
    {
        $this->param8 = $param8;

        return $this;
    }

    /**
     * Get param8
     *
     * @return string
     */
    public function getParam8()
    {
        return $this->param8;
    }

    /**
     * Set param9
     *
     * @param  string            $param9
     * @return ActivityAnalytics
     */
    public function setParam9($param9)
    {
        $this->param9 = $param9;

        return $this;
    }

    /**
     * Get param9
     *
     * @return string
     */
    public function getParam9()
    {
        return $this->param9;
    }

    /**
     * Set param10
     *
     * @param  string            $param10
     * @return ActivityAnalytics
     */
    public function setParam10($param10)
    {
        $this->param10 = $param10;

        return $this;
    }

    /**
     * Get param10
     *
     * @return string
     */
    public function getParam10()
    {
        return $this->param10;
    }
}
