<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emale
 *
 * @ORM\Table(name="percent")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PercentRepository")
 */
class Percent
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
     * @ORM\Column(name="percent", type="decimal", precision=5, scale=2)
     */
    private $percent;


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
     * Set emale
     *
     * @param string $percent
     *
     * @return Emale
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get emale
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }
}

