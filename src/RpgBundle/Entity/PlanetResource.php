<?php

namespace RpgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanetResource
 *
 * @ORM\Table(name="planet_resource")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\PlanetResourceRepository")
 */
class PlanetResource
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
     * @var Planet
     * @ORM\ManyToOne(targetEntity="RpgBundle\Entity\Planet", inversedBy="resources")
     * @ORM\JoinColumn(name="planet_id")

     */
    private $planet;

    /**
     * @return Planet
     */
    public function getPlanet()
    {
        return $this->planet;
    }

    /**
     * @param Planet $planet
     */
    public function setPlanet(Planet $planet)
    {
        $this->planet = $planet;
    }

    /**
     * @return Building
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param Building $resource
     */
    public function setResource(GameResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @var GameResource
     * @ORM\ManyToOne(targetEntity="RpgBundle\Entity\GameResource", inversedBy="resources")
     * @ORM\JoinColumn(name="resource_id")
     */
    private $resource;


    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;


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
     * Set amount
     *
     * @param integer $amount
     *
     * @return PlanetResource
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

