<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {        
        //echo rand(1, 100000);
        echo $request->query->get('id', 0);
        
        
        return $this->render('ShopMenuBundle:Default:index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
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
