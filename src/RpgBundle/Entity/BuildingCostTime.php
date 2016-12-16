<?php
/**
 * Created by PhpStorm.
 * User: Smart
 * Date: 16.12.2016 г.
 * Time: 17:20 ч.
 */

namespace RpgBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingCostTime
 *
 * @ORM\Table(name="building_cost_time")
 * @ORM\Entity(repositoryClass="RpgBundle\Repository\BuildingCostTimeRepository")
 */
class BuildingCostTime
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
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var Building
     *
     * @ORM\OneToOne(targetEntity="RpgBundle\Entity\Building", inversedBy="timeCost")
     * @ORM\JoinColumn(name="building_id")
     */
    private $building;

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
     * @return BuildingCostTime
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

