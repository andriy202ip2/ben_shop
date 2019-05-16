<?php

namespace Security\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;
use Security\UserBundle\Entity\User;
use AdminBundle\Entity\Oderemale;
use AdminBundle\Entity\Sendemale;

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
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request) {

        $Isuser = $this->getUser();
        if ($Isuser != null){
            return $this->redirectToRoute('shop_menu_homepage');
        }

        $user = new User();
        $form = $this->createForm('Security\UserBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && in_array($user->getRole(), array("ROLE_USER", "ROLE_TEAM"))) {

            $user->setIsActive(true);

            $user = $this->setPasword($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $user_post = $request->request->get('security_userbundle_user', "");
            $password = $user_post['password'];

            $view = $this->renderView('SecurityUserBundle:Login:new.user.txt.twig', array(
                'email' => $user->getEmail(),
                'password' => $password,

            ));

            $sendemale = new Sendemale();
            $sendemale->setSendemale($view);
            $sendemale->setData(new \DateTime());

            $message = \Swift_Message::newInstance()
                ->setSubject('Ви успішно зареєструвалися на gh-parts.com.ua')
                ->setFrom('send@example.com')
                ->setTo($user->getEmail())
                ->setBody(strip_tags($view));

            $this->get('mailer')->send($message);

            return $this->redirectToRoute('security_user_login');
        }

        return $this->render('SecurityUserBundle:Login:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


    /**
     * Never used due to Symfony's Security component
     */
    public function loginCheckAction(){
        
    }

        
    public function logoutAction(){}


    private function setPasword($user) {

        $encoderFactory = $this->get('security.encoder_factory');
        $encoder = $encoderFactory->getEncoder($user);

        $salt = $user->getSalt(); // this should be different for every user
        $password = $encoder->encodePassword($user->getPassword(), $salt);
        $user->setPassword($password);

        return $user;
    }

}
