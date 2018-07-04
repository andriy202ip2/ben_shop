<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        return $this->render('ShopMenuBundle:Products:index.html.twig', array(
                    'modelMenus' => $modelMenus,
        ));
    }

    public function autosAction(Request $request, $model_id) {

        $em = $this->getDoctrine()->getManager();
        $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                ->findByIdOrderedByName($model_id);

        $I = $em->getRepository('ShopMenuBundle:ModelMenu')
            ->findOneBy(["id" => $model_id]);

        return $this->render('ShopMenuBundle:Products:auto.html.twig', array(
                    'autoMenu' => $autoMenu,
                    'I' => $I,
        ));
    }

    public function dataAction($model_id, $auto_id) {

        $em = $this->getDoctrine()->getManager();
        $dataMenu = $em->getRepository('ShopMenuBundle:DataMenu')
                ->findByIdOrderedByName($model_id, $auto_id);

        $I = $em->getRepository('ShopMenuBundle:AutoMenu')
            ->findOneBy(["id" => $auto_id]);

        return $this->render('ShopMenuBundle:Products:data.html.twig', array(
                    'dataMenu' => $dataMenu,
                    'I' => $I,
        ));
    }

    public function itemsAction($model_id, $auto_id, $data_id, Request $request) {

        $s1 = $request->query->getInt('s1', 0);
        $s1 = $s1 >= 1 ? 1 : 0;

        $s2 = $request->query->getInt('s2', 0);
        $s2 = $s2 >= 1 ? 2 : 0;

        $t1 = $request->query->getInt('t1', 0);
        $t1 = $t1 >= 1 ? 1 : 0;

        $t2 = $request->query->getInt('t2', 0);
        $t2 = $t2 >= 1 ? 2 : 0;

        $t3 = $request->query->getInt('t3', 0);
        $t3 = $t3 >= 1 ? 4 : 0;

        $side = ($s1 + $s2) % 3;
        if (!$side) {
            $s1 = 1;
            $s2 = 2;
        }

        $t = $t1 + $t2 + $t3;
        if ($t == 0) {
            $t1 = 1;
            $t2 = 2;
            $t3 = 4;
        }
        if ($t == 7) {
            $t = 0;
        }

        $em = $this->getDoctrine()->getManager();
        $ItemsArray = $em->getRepository('ShopMenuBundle:Items')
                ->findByIdOrderedById($model_id, $auto_id, $data_id, $side, $t, $t1, $t2, $t3)
                ->getResult();

        $I = $em->getRepository('ShopMenuBundle:DataMenu')
            ->findOneBy(["id" => $data_id]);


        return $this->render('ShopMenuBundle:Products:items.html.twig', array(
                    'ItemsArray' => $ItemsArray,
                    's1' => $s1,
                    's2' => $s2,
                    't1' => $t1,
                    't2' => $t2,
                    't3' => $t3,
                    'I' => $I,
        ));
    }

}
