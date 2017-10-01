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
        $model_id = $request->query->getInt('mid', 0);
        if ($model_id < 0) {
           $model_id = 0;             
        }
        
        $auto_id = $request->query->getInt('aid', 0);
        if ($auto_id < 0) {
            $auto_id = 0;
        }
        
        $data_id = $request->query->getInt('did', 0);
        if ($data_id < 0) {
            $data_id = 0;
        }
        
        $s1 = $request->query->getInt('s1', 1);
        $s1 = $s1 >= 1 ? 1 : 0; 
        
        $s2 = $request->query->getInt('s2', 2);
        $s2 = $s2 >= 1 ? 2 : 0; 
                
        $side = ($s1 + $s2) % 3;
        if (!$side) {
           $s1 = 1;
           $s2 = 1;
        }
                
        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                         ->findAllOrderedByName();
        
        $autoMenu = null;
        if ($model_id) {
            $em = $this->getDoctrine()->getManager();
            $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                         ->findByIdOrderedByName($model_id);
        }
        
        
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
