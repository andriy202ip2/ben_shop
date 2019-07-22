<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emale
 *
 * @ORM\Table(name="emale")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EmaleRepository")
 */
class Emale
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
     * @ORM\Column(name="emale", type="string", length=255)
     */
    private $emale;

    /**
     * @var string
     *
     * @ORM\Column(name="emale2", type="string", length=255, nullable=true)
     */
    private $emale2;

    /**
     * @var string
     *
     * @ORM\Column(name="emale3", type="string", length=255, nullable=true)
     */
    private $emale3;

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
     * @param string $emale
     *
     * @return Emale
     */
    public function setEmale($emale)
    {
        $this->emale = $emale;

        return $this;
    }

    /**
     * Get emale
     *
     * @return string
     */
    public function getEmale()
    {
        return $this->emale;
    }

    /**
     * Set emale2
     *
     * @param string $emale2
     *
     * @return Emale2
     */
    public function setEmale2($emale2)
    {
        $this->emale2 = $emale2;

        return $this;
    }

    /**
     * Get emale2
     *
     * @return string
     */
    public function getEmale2()
    {
        return $this->emale2;
    }

    /**
     * Set emale3
     *
     * @param string $emale3
     *
     * @return Emale3
     */
    public function setEmale3($emale3)
    {
        $this->emale3 = $emale3;

        return $this;
    }

    /**
     * Get emale3
     *
     * @return string
     */
    public function getEmale3()
    {
        return $this->emale3;
    }
}

