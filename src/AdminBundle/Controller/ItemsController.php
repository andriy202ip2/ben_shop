<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item controller.
 *
 */
class ItemsController extends Controller
{
    /**
     * Lists all item entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('ShopMenuBundle:Items')->findAll();

        return $this->render('AdminBundle:Items:index.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     * Creates a new item entity.
     *
     */
    public function newAction(Request $request)
    {
                
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
    public function showAction(Items $item)
    {
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
    public function editAction(Request $request, Items $item)
    {
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
    public function deleteAction(Request $request, Items $item)
    {
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
    private function createDeleteForm(Items $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('items_delete', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
