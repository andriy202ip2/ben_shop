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

        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        $autoMenu = null;
        if ($model_id) {
            $em = $this->getDoctrine()->getManager();
            $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                    ->findByIdOrderedByName($model_id);
        }

        $em = $this->getDoctrine()->getManager();

        //$items = $em->getRepository('ShopMenuBundle:Items')->findAll();

        $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');
        if ($model_id > 0) {
            $dql = $dql->where('a.modelMenuId = :mid')->setParameter('mid', $model_id);

            if ($auto_id > 0) {
                $dql = $dql->andWhere('a.autoMenuId = :aid')->setParameter('aid', $auto_id);
            }
        }

        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');
        $items = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );


        return $this->render('AdminBundle:Items:index.html.twig', array(
                    'items' => $items,
                    'modelMenus' => $modelMenus,
                    'model_id' => $model_id,
                    'autoMenu' => $autoMenu,
                    'auto_id' => $auto_id,
        ));
    }

    /**
     * Creates a new item entity.
     *
     */
    public function newAction(Request $request) {

        $item = new Items();

        $form = $this->createForm('AdminBundle\Form\ItemsType', $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                    'item' => $item,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing item entity.
     *
     */
    public function editAction(Request $request, Items $item) {
        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm('AdminBundle\Form\ItemsType', $item);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
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
