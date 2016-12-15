<?php

namespace RpgBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BuildingsController extends Controller
{

    /**
     * @Route("/create_buildings", name="buildings_processes")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render("default/buildings_processes.html.twig");
    }
}
