<?php

namespace RpgBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
/**
 * Planet
 * @ORM\Table(name="planets")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\PlanetRepository")
 */
class Planet
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
     * @ORM\Column(name="name", type="string" ,length=255)
     */
    private $name;

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     * @return Planet
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="x", type="integer")
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer")
     */
    private $y;


    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="RpgBundle\Entity\Player", inversedBy="planets")
     * @ORM\JoinColumn(name="player_id")
     */
    private $player;


    /**
     * @var PlanetResource[]
     *
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\PlanetResource", mappedBy="planet")
     */

    private $resources;

    /**
     * @var PlanetBuilding[]
     * @ORM\OneToMany(targetEntity="RpgBundle\Entity\PlanetBuilding", mappedBy="planet")
     */
    private $buildings;

    /**
     * @return PlanetBuilding[]
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * @param PlanetBuilding[] $buildings
     */
    public function setBuildings(array $buildings)
    {
        $this->buildings = $buildings;
    }

    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->buildings = new ArrayCollection();
    }

    /**
     * @return PlanetResource[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param PlanetResource[] $resources
     */
    public function setResources(array $resources)
    {
        $this->resources = $resources;
    }



    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
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
     * Set x
     *
     * @param integer $x
     *
     * @return Planet
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     *
     * @return Planet
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set playerId
     *
     * @param integer $playerId
     *
     * @return Planet
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return int
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }
}

