<?php

namespace App\Controller;

use App\Entity\SwitchboardItems;
use App\Form\SwitchboardItemsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/switchboard/items")
 */
class SwitchboardItemsController extends AbstractController
{
    /**
     * @Route("/", name="switchboard_items_index", methods={"GET"})
     */
    public function index(): Response
    {
        $switchboardItems = $this->getDoctrine()
            ->getRepository(SwitchboardItems::class)
            ->findAll();

        return $this->render('switchboard_items/index.html.twig', [
            'switchboard_items' => $switchboardItems,
        ]);
    }

    /**
     * @Route("/new", name="switchboard_items_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $switchboardItem = new SwitchboardItems();
        $form = $this->createForm(SwitchboardItemsType::class, $switchboardItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($switchboardItem);
            $entityManager->flush();

            return $this->redirectToRoute('switchboard_items_index');
        }

        return $this->render('switchboard_items/new.html.twig', [
            'switchboard_item' => $switchboardItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{switchboardid}", name="switchboard_items_show", methods={"GET"})
     */
    public function show(SwitchboardItems $switchboardItem): Response
    {
        return $this->render('switchboard_items/show.html.twig', [
            'switchboard_item' => $switchboardItem,
        ]);
    }

    /**
     * @Route("/{switchboardid}/edit", name="switchboard_items_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SwitchboardItems $switchboardItem): Response
    {
        $form = $this->createForm(SwitchboardItemsType::class, $switchboardItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('switchboard_items_index', [
                'switchboardid' => $switchboardItem->getSwitchboardid(),
            ]);
        }

        return $this->render('switchboard_items/edit.html.twig', [
            'switchboard_item' => $switchboardItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{switchboardid}", name="switchboard_items_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SwitchboardItems $switchboardItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$switchboardItem->getSwitchboardid(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($switchboardItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('switchboard_items_index');
    }
}
