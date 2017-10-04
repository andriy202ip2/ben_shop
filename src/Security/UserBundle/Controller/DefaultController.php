<?php

namespace Security\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        /*
        $encoderFactory = $this->get('security.encoder_factory');
        $encoder = $encoderFactory->getEncoder($user);
        
        $salt = null; // this should be different for every user
        $password = $encoder->encodePassword($user->getPassword(), $salt);
        $user->setPassword($password);   
         */
        
        return $this->render('SecurityUserBundle:Default:index.html.twig');
    }
}
