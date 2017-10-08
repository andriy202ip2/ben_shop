<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\AutoMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Automenu controller.
 *
 */
class AutoMenuController extends Controller
{
    /**
     * Lists all autoMenu entities.
     *
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $autoMenus = $em->getRepository('ShopMenuBundle:AutoMenu')->findAll();

        return $this->render('AdminBundle:Automenu:index.html.twig', array(
            'autoMenus' => $autoMenus,
        ));
    }

    /**
     * Creates a new autoMenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $autoMenu = new Automenu();
        $form = $this->createForm('AdminBundle\Form\AutoMenuType', $autoMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($autoMenu);
            $em->flush();

            return $this->redirectToRoute('automenu_show', array('id' => $autoMenu->getId()));
        }

        return $this->render('AdminBundle:Automenu:new.html.twig', array(
            'autoMenu' => $autoMenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a autoMenu entity.
     *
     */
    public function showAction(AutoMenu $autoMenu)
    {
        $deleteForm = $this->createDeleteForm($autoMenu);

        return $this->render('AdminBundle:Automenu:show.html.twig', array(
            'autoMenu' => $autoMenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing autoMenu entity.
     *
     */
    public function editAction(Request $request, AutoMenu $autoMenu)
    {
        $deleteForm = $this->createDeleteForm($autoMenu);
        $editForm = $this->createForm('AdminBundle\Form\AutoMenuType', $autoMenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('automenu_edit', array('id' => $autoMenu->getId()));
        }

        return $this->render('AdminBundle:Automenu:edit.html.twig', array(
            'autoMenu' => $autoMenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a autoMenu entity.
     *
     */
    public function deleteAction(Request $request, AutoMenu $autoMenu)
    {
        $form = $this->createDeleteForm($autoMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($autoMenu);
            $em->flush();
        }

        return $this->redirectToRoute('automenu_index');
    }

    /**
     * Creates a form to delete a autoMenu entity.
     *
     * @param AutoMenu $autoMenu The autoMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AutoMenu $autoMenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('automenu_delete', array('id' => $autoMenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
