<?php

namespace Security\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Security\UserBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User extends BaseUser
{
    
    public function __toString() {        
        return $this->getUsername();
    }
    // * @ORM\Table(name="user",indexes={@ORM\Index(name="name_email_idx", columns={"name", "email"})})
}
