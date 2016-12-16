<?php

namespace RpgBundle\Controller;

use RpgBundle\Entity\Planet;
use RpgBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlanetAwareController extends Controller
{
    public function getPlanet()
    {
        $session = $this->get('session');
        /** @var Player $user */
        $user = $this->getUser();
        $planet = $this->get('session')->get('planet_id');
        if($planet == null) {
            $planet = $user->getPlanets()[0]->getId();
        $session->set('planet_id', $planet);
        }

        return $planet;

    }

    public function resourcesAction()
    {
        $id= $this->getPlanet();
        $planet = $this->getDoctrine()->getRepository(Planet::class)->find($id);
        return $this->render("planets/partials/resources.html.twig",['planet'=>$planet]);

    }

}
