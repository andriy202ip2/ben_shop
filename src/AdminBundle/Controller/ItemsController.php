<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item controller.
 *
 */
class ItemsController extends Controller {

    /**
     * Lists all item entities.
     *
     */
    public function indexAction(Request $request) {

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

        $s1 = $request->query->getInt('s1', 0);
        $s1 = $s1 >= 1 ? 1 : 0;

        $s2 = $request->query->getInt('s2', 0);
        $s2 = $s2 >= 1 ? 2 : 0;

        $side = ($s1 + $s2) % 3;
        if (!$side) {
            $s1 = 1;
            $s2 = 2;
        }

        $t1 = $request->query->getInt('t1', 0);
        $t1 = $t1 >= 1 ? 1 : 0;

        $t2 = $request->query->getInt('t2', 0);
        $t2 = $t2 >= 1 ? 2 : 0;

        $t3 = $request->query->getInt('t3', 0);
        $t3 = $t3 >= 1 ? 4 : 0;

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
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        $autoMenu = null;
        if ($model_id) {
            $em = $this->getDoctrine()->getManager();
            $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                    ->findByIdOrderedByName($model_id);
        }

        $dataMenu = null;
        if ($auto_id) {
            $em = $this->getDoctrine()->getManager();
            $dataMenu = $em->getRepository('ShopMenuBundle:DataMenu')
                    ->findByIdOrderedByName($model_id, $auto_id);
        }


        $serch = $request->query->get("serch", "");
        $serch = strip_tags($serch);
        $serch = strtr($serch, array('<' => " ", '>' => " ", ' ' => ""));
        $IsSerch = strlen($serch) > 1;
        if ($IsSerch) {

            $dql2 = $em
                ->getRepository('ShopMenuBundle:Ghcode')
                ->createQueryBuilder('i');

            $dql2 = $dql2->where('i.code = :serch')
                ->setParameter('serch', $serch)
                ->getQuery();
            $items = $dql2->getResult();
            $array_gh = array();
            foreach ($items as $item) {
                $array_gh[] = $item->getItemId();
            }
            $array_gh = array_unique($array_gh);

            $em = $this->getDoctrine()->getManager();
            $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('i');

            if (count($array_gh) != 0){

                $query = $dql
                    ->andWhere('i.itemId IN (:ids)')
                    ->setParameter('ids', $array_gh, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);

                $dql = $query->orderBy('i.id', 'ASC');

            } else {

                $dql = $dql->andwhere('i.itemId LIKE :serch')
                            ->orWhere('i.acsesorisId LIKE :serch')
                            ->setParameter('serch', '%' . $serch . '%');

            }

        } else {


            $em = $this->getDoctrine()->getManager();

            //$items = $em->getRepository('ShopMenuBundle:Items')->findAll();

            $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');
            if ($model_id > 0) {
                $dql = $dql->where('a.modelMenuId = :mid')->setParameter('mid', $model_id);

                if ($auto_id > 0) {
                    $dql = $dql->andWhere('a.autoMenuId = :aid')->setParameter('aid', $auto_id);

                    if ($data_id > 0) {
                        $dql = $dql->andWhere('a.dataMenuId = :did')->setParameter('did', $data_id);
                    }
                }
            }

            if ($side) {
                $dql = $dql->andWhere('a.sideId = :side')->setParameter('side', $side);
            }

            if($t){

                $arr = array();
                if ($t2){
                    $arr[] = 2;
                }
                if ($t1){
                    $arr[] = 3;
                }
                if ($t3){
                    $arr[] = 5;
                }

                $tId = "a.tId IN(".implode(",",$arr).")";
                $dql = $dql->andWhere($tId);
            }
        }
        
        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');
        $items = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );


        return $this->render('AdminBundle:Items:index.html.twig', array(
                    'IsSerch' => $IsSerch,
                    'items' => $items,
                    'modelMenus' => $modelMenus,
                    'model_id' => $model_id,
                    'autoMenu' => $autoMenu,
                    'auto_id' => $auto_id,
                    'dataMenu' => $dataMenu,
                    'data_id' => $data_id,
                    's1' => $s1,
                    's2' => $s2,
                    't1' => $t1,
                    't2' => $t2,
                    't3' => $t3,
        ));
    }

    /**
     * Creates a new item entity.
     *
     */
    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $no_submit = $request->request->getInt('no_submit', 0);

        $item = new Items();

        $form = $this->createForm('AdminBundle\Form\ItemsType', $item, array('em' => $em, 'no_submit' => $no_submit));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $no_submit >= 2) {

            if ($item->getImg() != NULL) {
                $item = $item->saveImg($item, $this->getParameter('img_directory'));
            }

            if ($item->getAcsesorisImg() != NULL) {
                $item = $item->saveAcsesorisImg($item, $this->getParameter('img_directory'));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('items_show', array('id' => $item->getId()));
        }

        return $this->render('AdminBundle:Items:new.html.twig', array(
                    'item' => $item,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a item entity.
     *
     */
    public function showAction(Items $item) {
        $deleteForm = $this->createDeleteForm($item);

        return $this->render('AdminBundle:Items:show.html.twig', array(
                    'Item' => $item,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing item entity.
     *
     */
    public function editAction(Request $request, Items $item) {

        $em = $this->getDoctrine()->getManager();
        $db_item = $em->getRepository('ShopMenuBundle:Items')->findOneBy(["id" => $item->getId()])->getImg();
        $db_item2 = $em->getRepository('ShopMenuBundle:Items')->findOneBy(["id" => $item->getId()])->getAcsesorisImg();

        $no_submit = $request->request->getInt('no_submit', 0);

        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm('AdminBundle\Form\ItemsType', $item, array('em' => $em, 'no_submit' => $no_submit));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid() && $no_submit >= 2) {

            if ($item->getImg() == NULL) {
                $item->setImg($db_item);
            } else {
                $item = $item->saveImg($item, $this->getParameter('img_directory'), $db_item);
            }

            if ($item->getAcsesorisImg() == NULL) {
                $item->setAcsesorisImg($db_item2);
            } else {
                $item = $item->saveAcsesorisImg($item, $this->getParameter('img_directory'), $db_item2);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('items_edit', array('id' => $item->getId()));
        }

        return $this->render('AdminBundle:Items:edit.html.twig', array(
                    'item' => $item,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a item entity.
     *
     */
    public function deleteAction(Request $request, Items $item) {
        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $item->removeImg($item->getImg(), $this->getParameter('img_directory'));
            $item->removeImg($item->getAcsesorisImg(), $this->getParameter('img_directory'));

            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('items_index');
    }

    /**
     * Creates a form to delete a item entity.
     *
     * @param Items $item The item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Items $item) {

        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('items_delete', array('id' => $item->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
