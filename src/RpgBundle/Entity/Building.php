<?php

namespace RpgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\BuildingRepository")
 */
class Building
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
     * @var BuildingCostResource[]
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\BuildingCostResource", mappedBy="building")
     */
    private $costs;


    /**
     * @var BuildingCostTime
     * @ORM\OneToOne(targetEntity="RpgBundle\Entity\BuildingCostTime", mappedBy="building")
     */
    private $timeCost;

    /**
     * @return BuildingCostResource[]
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param BuildingCostResource[] $costs
     */
    public function setCosts(array $costs)
    {
        $this->costs = $costs;
    }

    /**
     * @return BuildingCostTime
     */
    public function getTimeCost()
    {
        return $this->timeCost;
    }

    /**
     * @param BuildingCostTime $timeCost
     */
    public function setTimeCost(BuildingCostTime $timeCost)
    {
        $this->timeCost = $timeCost;
    }

    /**
     * @return PlanetBuilding[]
     */
    public function getPlanetBuildings(): array
    {
        return $this->planetBuildings;
    }

    /**
     * @param PlanetBuilding[] $planetBuildings
     */
    public function setPlanetBuildings(array $planetBuildings)
    {
        $this->planetBuildings = $planetBuildings;
    }


    /**
     * @var PlanetBuilding[]
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\PlanetBuilding", mappedBy="building")
     */
    private $planetBuildings;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    public function __construct()
    {
        $this->costs = new ArrayCollection();
        $this->planetBuildings = new ArrayCollection();
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
     * @return Building
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

