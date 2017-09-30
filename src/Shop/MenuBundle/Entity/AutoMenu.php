<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoMenu
 *
 * @ORM\Table(name="auto_menu")
 * @ORM\Entity
 */
class AutoMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="model_menu_id", type="integer", nullable=false)
     */
    private $modelMenuId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

