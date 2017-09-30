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


}

