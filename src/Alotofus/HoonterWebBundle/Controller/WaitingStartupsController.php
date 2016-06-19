<?php

namespace Alotofus\HoonterWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WaitingStartupsController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $waitingStartups = $em->getRepository('AlotofusHoonterWebBundle:WaitingStartups')->findAll();
        
       
                     return $this->render('AlotofusHoonterWebBundle:WaitingStartups:index.html.twig', array('waitingStartups' => $waitingStartups)); 
    }
}