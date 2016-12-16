<?php

namespace RpgBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Resource
 *
 * @ORM\Table(name="resources")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\ResourceRepository")
 */
class GameResource
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     *
     * @var BuildingCostResource []
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\BuildingCostResource", mappedBy="resource")
     */
    private $buildingCosts;

    /**
     * @return BuildingCostResource[]
     */
    public function getBuildingCosts(): array
    {
        return $this->buildingCosts;
    }

    /**
     * @param BuildingCostResource[] $buildingCosts
     */
    public function setBuildingCosts(array $buildingCosts)
    {
        $this->buildingCosts = $buildingCosts;
    }




    /**
     * @var PlanetResource []
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\PlanetResource", mappedBy="resource")
     */

    private $planetResources;

    public function __construct()
    {
        $this->planetResources = new ArrayCollection();
        $this->buildingCosts = new ArrayCollection();
    }

    /**
     * @return PlanetResource[]
     */
    public function getPlanetResources()
    {
        return $this->planetResources;
    }

    /**
     * @param PlanetResource[] $planetResources
     */
    public function setPlanetResources(array $planetResources)
    {
        $this->planetResources = $planetResources;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return GameResource
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

