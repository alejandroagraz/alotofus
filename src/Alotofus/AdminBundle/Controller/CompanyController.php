<?php

namespace Alotofus\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompanyController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlotofusAdminBundle:Company:index.html.twig');
    }
}
