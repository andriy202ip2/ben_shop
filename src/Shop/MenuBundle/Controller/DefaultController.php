<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shop\MenuBundle\Entity\ModelMenu;
//use Shop\MenuBundle\Repository;
//use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {        
        //echo rand(1, 100000);
        echo $request->query->get('id', 0);
                
        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                        ->findAllOrderedByName();
              
        return $this->render('ShopMenuBundle:Default:index.html.twig', array(
            'modelMenus' => $modelMenus,
        ));
    }
    
    public function testAction()
    {
        echo "rand(1, 100000)";
        return $this->render('ShopMenuBundle:Default:index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
