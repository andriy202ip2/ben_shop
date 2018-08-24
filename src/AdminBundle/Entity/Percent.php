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
     * @var string
     *
     * @ORM\Column(name="percent_wholesaler", type="decimal", precision=5, scale=2)
     */
    private $percentWholesaler;

    /**
     * @var string
     *
     * @ORM\Column(name="percent_dropshipper", type="decimal", precision=5, scale=2)
     */
    private $percentDropshipper;

    /**
     * @var string
     *
     * @ORM\Column(name="cheat", type="decimal", precision=5, scale=2)
     */
    private $cheat;

    /**
     * @var string
     *
     * @ORM\Column(name="cheat_wholesaler", type="decimal", precision=5, scale=2)
     */
    private $cheatWholesaler;


    /**
     * @var string
     *
     * @ORM\Column(name="cheat_dropshipper", type="decimal", precision=5, scale=2)
     */
    private $cheatDropshipper;

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

    /**
     * Set percentWholesaler
     *
     * @param string $percentWholesaler
     *
     * @return Percent
     */
    public function setPercentWholesaler($percentWholesaler)
    {
        $this->percentWholesaler = $percentWholesaler;

        return $this;
    }

    /**
     * Get percentWholesaler
     *
     * @return string
     */
    public function getPercentWholesaler()
    {
        return $this->percentWholesaler;
    }

    /**
     * Set cheat
     *
     * @param string $cheat
     *
     * @return Percent
     */
    public function setCheat($cheat)
    {
        $this->cheat = $cheat;

        return $this;
    }

    /**
     * Get cheat
     *
     * @return string
     */
    public function getCheat()
    {
        return $this->cheat;
    }

    /**
     * Set cheatWholesaler
     *
     * @param string $cheatWholesaler
     *
     * @return Percent
     */
    public function setCheatWholesaler($cheatWholesaler)
    {
        $this->cheatWholesaler = $cheatWholesaler;

        return $this;
    }

    /**
     * Get cheatWholesaler
     *
     * @return string
     */
    public function getCheatWholesaler()
    {
        return $this->cheatWholesaler;
    }

    /**
     * Set percentDropshipper
     *
     * @param string $percentDropshipper
     *
     * @return Percent
     */
    public function setPercentDropshipper($percentDropshipper)
    {
        $this->percentDropshipper = $percentDropshipper;

        return $this;
    }

    /**
     * Get percentDropshipper
     *
     * @return string
     */
    public function getPercentDropshipper()
    {
        return $this->percentDropshipper;
    }

    /**
     * Set cheatDropshipper
     *
     * @param string $cheatDropshipper
     *
     * @return Percent
     */
    public function setCheatDropshipper($cheatDropshipper)
    {
        $this->cheatDropshipper = $cheatDropshipper;

        return $this;
    }

    /**
     * Get cheatDropshipper
     *
     * @return string
     */
    public function getCheatDropshipper()
    {
        return $this->cheatDropshipper;
    }
}
