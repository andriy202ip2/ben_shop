<?php

namespace Security\UserBundle\Repository;

class UserRepository extends BaseUserRepository
{
    public function supportsClass($class) {
        return $class === 'Security\UserBundle\Entity\User';
    }
}
