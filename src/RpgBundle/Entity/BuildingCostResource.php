<?php
/**
 * Created by PhpStorm.
 * User: Smart
 * Date: 16.12.2016 г.
 * Time: 17:11 ч.
 */

namespace RpgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingCostResource
 *
 * @ORM\Table(name="building_cost_resources")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\BuildingRepository")
 */
class BuildingCostResource
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
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="RpgBundle\Entity\Building", inversedBy="costs")
     * @ORM\JoinColumn(name="building_id")
     */
    private $building;

    /**
     * @var GameResource
     *
     * @ORM\ManyToOne(targetEntity="RpgBundle\Entity\GameResource", inversedBy="buildingCosts")
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
     * @return BuildingCostResource
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

    /**
     * @return Building
     */
    public function getBuilding(): Building
    {
        return $this->building;
    }

    /**
     * @param Building $building
     */
    public function setBuilding(Building $building)
    {
        $this->building = $building;
    }

    /**
     * @return GameResource
     */
    public function getResource(): GameResource
    {
        return $this->resource;
    }

    /**
     * @param GameResource $resource
     */
    public function setResource(GameResource $resource)
    {
        $this->resource = $resource;
    }


}

