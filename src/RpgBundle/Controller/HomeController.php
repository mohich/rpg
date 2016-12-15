<?php

namespace RpgBundle\Controller;

use RpgBundle\Entity\Player;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class HomeController extends Controller
{
    /**
     * @Route("/", name="rpg_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if ($user) {
            $session = $this->get('session');
            if(!$session->has('planet_id')) {
                $session->set('planet_id', $user->getPlanets()[0]);
            }
        }
        return $this->render('rpg/index');
    }
}