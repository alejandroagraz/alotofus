<?php

namespace Alotofus\AnalyticsBundle\Twig;

class AnalyticsExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'analyticStatistics' => new \Twig_Function_Method(
                $this,
                'analyticStatistics',
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * @param $firstAnalytic
     * @param $lastAnalytic
     *
     * @return string
     */
    public function analyticStatistics($firstAnalytic, $lastAnalytic)
    {
        //current value
        $html = "".$lastAnalytic;
        //increase or decrease arrow
        //$html.= "<i data-icon='". ($firstAnalytic > $lastAnalytic ? 'down' : 'up') . "'></i>";
        //Amount of increased/decreased
        $html .= " (";
        $html .= $lastAnalytic > $firstAnalytic ? '+' : '';
        $html .= $lastAnalytic - $firstAnalytic.")";

        return $html;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'analytics_extension';
    }
}
