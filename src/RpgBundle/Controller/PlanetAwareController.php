<?php

namespace RpgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlanetAwareController extends Controller
{
    public function getPlanet()
    {
        return $this->get('session')->get('planet_id');
    }
}
