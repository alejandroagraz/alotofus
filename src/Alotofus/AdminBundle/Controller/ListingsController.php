<?php

namespace Alotofus\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ListingsController extends Controller
{
    private $repository;
    protected $container;
    private $resourceName;

    public function __construct($repository, ContainerInterface $container, $resourceName)
    {
        $this->repository = $repository;
        $this->container = $container;
        $this->resourceName = $resourceName;
    }
    public function indexAction()
    {
        //$resources = $this->getDoctrine()->getRepository($this->repository)->findBy(array(),array(),20,0);
        return $this->render("AlotofusAdminBundle:Listings:index.html.twig", array(
            'resourceName' => $this->resourceName
        ));

    }

    public function newAction()
    {

    }

    public function editAction()
    {

    }
}
