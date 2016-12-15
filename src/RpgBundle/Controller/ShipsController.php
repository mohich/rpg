<?php

namespace RpgBundle\Controller;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShipsController extends Controller
{
    /**
     * @Route("/create_ships", name="ships_processes")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('', array('ship_process.html.twig'));
    }
}
