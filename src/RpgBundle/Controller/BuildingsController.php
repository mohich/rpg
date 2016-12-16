<?php

namespace RpgBundle\Controller;

use RpgBundle\Entity\Building;
use RpgBundle\Entity\GameResource;
use RpgBundle\Entity\Planet;
use RpgBundle\Entity\PlanetBuilding;
use RpgBundle\Entity\PlanetResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
    * Class BuildingsController
    * @package RpgBundle\Controller
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    */
class BuildingsController extends PlanetAwareController
{
    /**
     * @Route("/buildings", name="buildings_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $planet = $this->getDoctrine()->getRepository(Planet::class)->find($this->getPlanet());
        $resources = $this->getDoctrine()->getRepository(GameResource::class)->findAll();
        return $this->render('buildings/index.html.twig', [
            'buildings' => $planet->getBuildings(),
            'resources' => $resources
        ]);
    }

    /**
     * @Route("/buildings/evolve/{id}", name="evolve")
     * @param $id
     */
    public function evolve($id)
    {
        $planet = $this->getDoctrine()->getRepository(Planet::class)->find($this->getPlanet());
        $building = $this->getDoctrine()->getRepository(Building::class)->find($id);
        $planetBuilding = $this->getDoctrine()->getRepository(PlanetBuilding::class)
            ->findOneBy(['planet'=>$planet,'building'=>$building]);
        $currentLevel = $planetBuilding->getLevel();
        $costs = $building->getCosts();
        echo '$cost e null!!!';exit;
        $allResources = [];
        foreach ($costs as $cost) {
            $resourcesInPlanet = $this->getDoctrine()->getRepository(PlanetResource::class)
                ->findOneBy(['resource'=>$cost->getResource(),'planet'=>$planet]);
            if ($resourcesInPlanet->getAmount() >= ($cost->getAmount() * ($currentLevel + 1))) {
                $allResources[$cost->getResource()->getName()] = ($cost->getAmount() * ($currentLevel + 1));
            } else {
                return $this->redirectToRoute("buildings_list");
            }
        }

        $planetResources = $this->getDoctrine()->getRepository(PlanetResource::class)
            ->findBy(['planet'=>$planet]);

        $em = $this->getDoctrine()->getManager();
        foreach ($planetResources as $planetResource) {
            $name = $planetResource->getResource()->getName();
            $cost = $allResources[$name];
            $planetResource->setAmount(
                $planetResource->getAmount() - $cost
            );
            $em->persist($planetResource);
            $em->flush();
        }

        $planetBuilding->setLevel($currentLevel + 1);
        $em->persist($planetBuilding);
        $em->flush();

        return $this->redirectToRoute("buildings_list");
    }
}
