<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        echo rand(1, 100000);
        return $this->render('ShopMenuBundle:Default:index.html.twig');
    }
}
