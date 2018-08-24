<?php

namespace Security\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $em = $this->getDoctrine()->getManager();
        $Partnertxt = $em->getRepository('AdminBundle:Partnertxt')->findOneBy([]);

        return $this->render('SecurityUserBundle:Login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'Partnertxt'         => $Partnertxt,
        ));
        
    }
    

    /**
     * Never used due to Symfony's Security component
     */
    public function loginCheckAction(){
        
    }

        
    public function logoutAction(){}
    
}
