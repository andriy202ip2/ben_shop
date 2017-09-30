<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items", indexes={@ORM\Index(name="model_menu_id", columns={"model_menu_id"}), @ORM\Index(name="auto_menu_id", columns={"auto_menu_id"}), @ORM\Index(name="data_menu_id", columns={"data_menu_id"}), @ORM\Index(name="side_id", columns={"side_id"})})
 * @ORM\Entity
 */
class Items
{
    /**
     * @var integer
     *
     * @ORM\Column(name="model_menu_id", type="integer", nullable=false)
     */
    private $modelMenuId;

    /**
     * @var integer
     *
     * @ORM\Column(name="auto_menu_id", type="integer", nullable=false)
     */
    private $autoMenuId;

    /**
     * @var integer
     *
     * @ORM\Column(name="data_menu_id", type="integer", nullable=false)
     */
    private $dataMenuId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="side_id", type="boolean", nullable=false)
     */
    private $sideId;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text", length=65535, nullable=false)
     */
    private $details;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="item_id", type="string", length=256, nullable=false)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="side", type="text", length=65535, nullable=false)
     */
    private $side;

    /**
     * @var string
     *
     * @ORM\Column(name="fit", type="text", length=65535, nullable=false)
     */
    private $fit;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=256, nullable=false)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="img_data", type="text", length=65535, nullable=false)
     */
    private $imgData;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set modelMenuId
     *
     * @param integer $modelMenuId
     *
     * @return Items
     */
    public function setModelMenuId($modelMenuId)
    {
        $this->modelMenuId = $modelMenuId;

        return $this;
    }

    /**
     * Get modelMenuId
     *
     * @return integer
     */
    public function getModelMenuId()
    {
        return $this->modelMenuId;
    }

    /**
     * Set autoMenuId
     *
     * @param integer $autoMenuId
     *
     * @return Items
     */
    public function setAutoMenuId($autoMenuId)
    {
        $this->autoMenuId = $autoMenuId;

        return $this;
    }

    /**
     * Get autoMenuId
     *
     * @return integer
     */
    public function getAutoMenuId()
    {
        return $this->autoMenuId;
    }

    /**
     * Set dataMenuId
     *
     * @param integer $dataMenuId
     *
     * @return Items
     */
    public function setDataMenuId($dataMenuId)
    {
        $this->dataMenuId = $dataMenuId;

        return $this;
    }

    /**
     * Get dataMenuId
     *
     * @return integer
     */
    public function getDataMenuId()
    {
        return $this->dataMenuId;
    }

    /**
     * Set sideId
     *
     * @param boolean $sideId
     *
     * @return Items
     */
    public function setSideId($sideId)
    {
        $this->sideId = $sideId;

        return $this;
    }

    /**
     * Get sideId
     *
     * @return boolean
     */
    public function getSideId()
    {
        return $this->sideId;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Items
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Items
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

    /**
     * Set itemId
     *
     * @param string $itemId
     *
     * @return Items
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
     * Set side
     *
     * @param string $side
     *
     * @return Items
     */
    public function setSide($side)
    {
        $this->side = $side;

        return $this;
    }

    /**
     * Get side
     *
     * @return string
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Set fit
     *
     * @param string $fit
     *
     * @return Items
     */
    public function setFit($fit)
    {
        $this->fit = $fit;

        return $this;
    }

    /**
     * Get fit
     *
     * @return string
     */
    public function getFit()
    {
        return $this->fit;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Items
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set imgData
     *
     * @param string $imgData
     *
     * @return Items
     */
    public function setImgData($imgData)
    {
        $this->imgData = $imgData;

        return $this;
    }

    /**
     * Get imgData
     *
     * @return string
     */
    public function getImgData()
    {
        return $this->imgData;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}