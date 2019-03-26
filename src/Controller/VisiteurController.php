<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visiteur")
 */
class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="visiteur_index", methods={"GET"})
     */
    public function index(): Response
    {
        $visiteurs = $this->getDoctrine()
            ->getRepository(Visiteur::class)
            ->findAll();

        return $this->render('visiteur/index.html.twig', [
            'visiteurs' => $visiteurs,
        ]);
    }

    /**
     * @Route("/new", name="visiteur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiteur);
            $entityManager->flush();

            return $this->redirectToRoute('visiteur_index');
        }

        return $this->render('visiteur/new.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="visiteur_show", methods={"GET"})
     */
    public function show(Visiteur $visiteur): Response
    {
        return $this->render('visiteur/show.html.twig', [
            'visiteur' => $visiteur,
        ]);
    }

    /**
     * @Route("/{visMatricule}/edit", name="visiteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visiteur $visiteur): Response
    {
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visiteur_index', [
                'visMatricule' => $visiteur->getVisMatricule(),
            ]);
        }

        return $this->render('visiteur/edit.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="visiteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Visiteur $visiteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visiteur->getVisMatricule(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visiteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visiteur_index');
    }
}
