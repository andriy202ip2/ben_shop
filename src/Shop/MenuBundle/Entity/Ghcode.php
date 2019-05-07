<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Ghcode
 *
 * @ORM\Table(name="ghcode", indexes={@ORM\Index(name="search_idx", columns={"item_id", "code"})})
 * @ORM\Entity(repositoryClass="Shop\MenuBundle\Repository\GhcodeRepository")
 */
class Ghcode
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
     * @ORM\Column(name="item_id", type="string", length=255)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;


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
     * Set itemId
     *
     * @param string $itemId
     *
     * @return Ghcode
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Ghcode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}

