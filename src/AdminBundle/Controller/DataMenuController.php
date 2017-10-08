<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\DataMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Datamenu controller.
 *
 */
class DataMenuController extends Controller
{
    /**
     * Lists all dataMenu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dataMenus = $em->getRepository('ShopMenuBundle:DataMenu')->findAll();

        return $this->render('AdminBundle:Datamenu:index.html.twig', array(
            'dataMenus' => $dataMenus,
        ));
    }

    /**
     * Creates a new dataMenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $dataMenu = new Datamenu();
        $form = $this->createForm('AdminBundle\Form\DataMenuType', $dataMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dataMenu);
            $em->flush();

            return $this->redirectToRoute('datamenu_show', array('id' => $dataMenu->getId()));
        }

        return $this->render('AdminBundle:Datamenu:new.html.twig', array(
            'dataMenu' => $dataMenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dataMenu entity.
     *
     */
    public function showAction(DataMenu $dataMenu)
    {
        $deleteForm = $this->createDeleteForm($dataMenu);

        return $this->render('AdminBundle:Datamenu:show.html.twig', array(
            'dataMenu' => $dataMenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dataMenu entity.
     *
     */
    public function editAction(Request $request, DataMenu $dataMenu)
    {
        $deleteForm = $this->createDeleteForm($dataMenu);
        $editForm = $this->createForm('AdminBundle\Form\DataMenuType', $dataMenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('datamenu_edit', array('id' => $dataMenu->getId()));
        }

        return $this->render('AdminBundle:Datamenu:edit.html.twig', array(
            'dataMenu' => $dataMenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dataMenu entity.
     *
     */
    public function deleteAction(Request $request, DataMenu $dataMenu)
    {
        $form = $this->createDeleteForm($dataMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dataMenu);
            $em->flush();
        }

        return $this->redirectToRoute('datamenu_index');
    }

    /**
     * Creates a form to delete a dataMenu entity.
     *
     * @param DataMenu $dataMenu The dataMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DataMenu $dataMenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('datamenu_delete', array('id' => $dataMenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
