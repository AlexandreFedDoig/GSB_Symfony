<?php

namespace App\Controller;

use App\Entity\Prescrire;
use App\Form\PrescrireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prescrire")
 */
class PrescrireController extends AbstractController
{
    /**
     * @Route("/", name="prescrire_index", methods={"GET"})
     */
    public function index(): Response
    {
        $prescrires = $this->getDoctrine()
            ->getRepository(Prescrire::class)
            ->findAll();

        return $this->render('prescrire/index.html.twig', [
            'prescrires' => $prescrires,
        ]);
    }

    /**
     * @Route("/new", name="prescrire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prescrire = new Prescrire();
        $form = $this->createForm(PrescrireType::class, $prescrire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prescrire);
            $entityManager->flush();

            return $this->redirectToRoute('prescrire_index');
        }

        return $this->render('prescrire/new.html.twig', [
            'prescrire' => $prescrire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="prescrire_show", methods={"GET"})
     */
    public function show(Prescrire $prescrire): Response
    {
        return $this->render('prescrire/show.html.twig', [
            'prescrire' => $prescrire,
        ]);
    }

    /**
     * @Route("/{medDepotlegal}/edit", name="prescrire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prescrire $prescrire): Response
    {
        $form = $this->createForm(PrescrireType::class, $prescrire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prescrire_index', [
                'medDepotlegal' => $prescrire->getMedDepotlegal(),
            ]);
        }

        return $this->render('prescrire/edit.html.twig', [
            'prescrire' => $prescrire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="prescrire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Prescrire $prescrire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prescrire->getMedDepotlegal(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prescrire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prescrire_index');
    }
}
