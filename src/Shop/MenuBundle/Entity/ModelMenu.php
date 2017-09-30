<?php

namespace Shop\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModelMenu
 *
 * @ORM\Table(name="model_menu")
 * @ORM\Entity
 */
class ModelMenu
{
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

