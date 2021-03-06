<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shop\MenuBundle\Entity\Items;
use Shop\MenuBundle\Entity\Ghcode;
use Tbbc\MoneyBundle\Form\Type\MoneyType;
use Money\Money;


class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function add_pricesAction(Request $request) {

        $noteFonde = array();
        $isSave = 0;
        
        $editForm = $this->createForm('AdminBundle\Form\AddPricesType');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $isSave = 1;
            
            $em = $this->getDoctrine()->getManager();
            
            $data = $editForm->getData();
            $arr = explode("|", $data["list"]);
            foreach ($arr as $val) {
                $arr2 = explode("{", $val);

                if (count($arr2) == 2) {

                    $arr3 = explode("}", $arr2[1]);

                    $id = preg_replace('/\s+/', '', $arr2[0]);

                    $prise = preg_replace('/\s+/', '', $arr3[0]);
                    $is = preg_replace('/\s+/', '', $arr3[1]);

                    $prise = str_replace(array(","), array("."), $prise);

                    //$prise = $prise * ($data['curling'] / 100 + 1);
                    $prise = round($prise, 2) * 100;     
                    
                    //echo $id . '<br>';
                    //echo $prise . '<br>';

                    $IsnoteFonde = $this->SetItemsPrice($em, $id, $prise, $is);

                    if ($IsnoteFonde){
                        $IsnoteFonde = $this->SetAcsesoryPrice($em, $id, $prise, $is);
                        if ($IsnoteFonde){
                            $noteFonde[] = $id;
                        }
                    }

                }
            }

            $this->getDoctrine()->getManager()->flush();
            //
            //return $this->redirectToRoute('admin_add_prices');
        }

        return $this->render('AdminBundle:Default:addprices.html.twig', array(
                    'edit_form' => $editForm->createView(),
                    "noteFonde" => implode(", ", $noteFonde),
                    "isSave" => $isSave
        ));
    }

    public function ghcodeAction(Request $request) {

        $noteFonde = array();
        $isSave = 0;

        $editForm = $this->createForm('AdminBundle\Form\AddGhcodeType');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $em = $this->getDoctrine()->getManager();

            $connection = $em->getConnection();
            $platform   = $connection->getDatabasePlatform();
            $connection->executeUpdate($platform->getTruncateTableSQL('ghcode', true /* whether to cascade */));

            $isSave = 1;

            $em = $this->getDoctrine()->getManager();

            $data = $editForm->getData();
            $arr = explode("}|", $data["list"]);
            foreach ($arr as $val) {
                $arr2 = explode("{", $val);

                if (count($arr2) == 2) {

                    $id = preg_replace('/\s+/', '', $arr2[0]);

                    $arr3 = explode(",", $arr2[1]);
                    foreach ($arr3 as $val2) {

                        $code = preg_replace('/\s+/', '', $val2);
                        if(mb_strlen($code) > 2){

                            $Ghcode = new Ghcode();
                            $Ghcode = $Ghcode->setItemId($id);
                            $Ghcode = $Ghcode->setCode($code);
                            $em->persist($Ghcode);

                            //echo $code.'<br>';
                        }
                    }


                }
            }

            $em->flush();
            //$this->getDoctrine()->getManager()->flush();
            //
            //return $this->redirectToRoute('admin_add_prices');
        }

        return $this->render('AdminBundle:Default:ghcode.html.twig', array(
            'edit_form' => $editForm->createView(),
            "noteFonde" => implode(", ", $noteFonde),
            "isSave" => $isSave
        ));
    }

/*    public function add_prices_acsesoryAction(Request $request) {

        $noteFonde = "";
        $isSave = 0;

        $editForm = $this->createForm('AdminBundle\Form\AddPricesType');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $isSave = 1;

            $em = $this->getDoctrine()->getManager();

            $data = $editForm->getData();
            $arr = explode("|", $data["list"]);
            foreach ($arr as $val) {
                $arr2 = explode("{", $val);

                if (count($arr2) == 2) {

                    $arr3 = explode("}", $arr2[1]);

                    $id = preg_replace('/\s+/', '', $arr2[0]);

                    $prise = preg_replace('/\s+/', '', $arr3[0]);
                    $is = preg_replace('/\s+/', '', $arr3[1]);

                    $prise = str_replace(array(","), array("."), $prise);

                    //$prise = $prise * ($data['curling'] / 100 + 1);
                    $prise = round($prise, 2) * 100;

                    //echo $id . '<br>';
                    //echo $prise . '<br>';

                    $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');;
                    $dql = $dql->where('a.acsesorisId = :id')
                        ->setParameter('id', $id)
                        ->getQuery();

                    $items = $dql->getResult();
                    $i = 0;
                    foreach ($items as $item) {
                        $i++;

                        $money = Money::UAH($prise);
                        $item->setAcsesorisPrice($money);
                        $item->setAcsesoriIs($is);
                        //exit();
                    }
                    if ($i == 0) {
                        $noteFonde .= " , ".$id;
                    }

                }
            }

            $this->getDoctrine()->getManager()->flush();
            //
            //return $this->redirectToRoute('admin_add_prices');
        }

        return $this->render('AdminBundle:Default:addpricesAcsesory.html.twig', array(
            'edit_form' => $editForm->createView(),
            "noteFonde" => $noteFonde,
            "isSave" => $isSave
        ));
    }*/

    /**
     * @param $em
     * @param $id
     * @param $prise
     * @param $is
     * @param $noteFonde
     * @return array
     */
    private function SetItemsPrice($em, $id, $prise, $is)
    {
        $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');
        $dql = $dql->where('a.itemId = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $items = $dql->getResult();
        $i = 0;
        foreach ($items as $item) {
            $i++;

            $money = Money::UAH($prise);
            $item->setPrice($money);
            $item->setItemIs($is);

            //exit();
        }

        return $i == 0;

    }

    /**
     * @param $em
     * @param $id
     * @param $prise
     * @param $is
     * @param $noteFonde
     * @return array
     */
    private function SetAcsesoryPrice($em, $id, $prise, $is)
    {
        $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');;
        $dql = $dql->where('a.acsesorisId = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $items = $dql->getResult();
        $i = 0;
        foreach ($items as $item) {
            $i++;

            $money = Money::UAH($prise);
            $item->setAcsesorisPrice($money);
            $item->setAcsesoriIs($is);

            //exit();
        }

        return $i == 0;

    }
}
