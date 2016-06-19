<?php

namespace Alotofus\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvitationsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlotofusAdminBundle:Invitations:index.html.twig');
    }
}
