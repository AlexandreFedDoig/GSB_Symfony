<?php

namespace App\Controller;

use App\Entity\Constituer;
use App\Form\ConstituerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/constituer")
 */
class ConstituerController extends AbstractController
{
    /**
     * @Route("/", name="constituer_index", methods={"GET"})
     */
    public function index(): Response
    {
        $constituers = $this->getDoctrine()
            ->getRepository(Constituer::class)
            ->findAll();

        return $this->render('constituer/index.html.twig', [
            'constituers' => $constituers,
        ]);
    }

    /**
     * @Route("/new", name="constituer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $constituer = new Constituer();
        $form = $this->createForm(ConstituerType::class, $constituer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($constituer);
            $entityManager->flush();

            return $this->redirectToRoute('constituer_index');
        }

        return $this->render('constituer/new.html.twig', [
            'constituer' => $constituer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="constituer_show", methods={"GET"})
     */
    public function show(Constituer $constituer): Response
    {
        return $this->render('constituer/show.html.twig', [
            'constituer' => $constituer,
        ]);
    }

    /**
     * @Route("/{medDepotlegal}/edit", name="constituer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Constituer $constituer): Response
    {
        $form = $this->createForm(ConstituerType::class, $constituer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('constituer_index', [
                'medDepotlegal' => $constituer->getMedDepotlegal(),
            ]);
        }

        return $this->render('constituer/edit.html.twig', [
            'constituer' => $constituer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="constituer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Constituer $constituer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$constituer->getMedDepotlegal(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($constituer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('constituer_index');
    }
}
