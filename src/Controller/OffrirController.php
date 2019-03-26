<?php

namespace App\Controller;

use App\Entity\Offrir;
use App\Form\OffrirType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offrir")
 */
class OffrirController extends AbstractController
{
    /**
     * @Route("/", name="offrir_index", methods={"GET"})
     */
    public function index(): Response
    {
        $offrirs = $this->getDoctrine()
            ->getRepository(Offrir::class)
            ->findAll();

        return $this->render('offrir/index.html.twig', [
            'offrirs' => $offrirs,
        ]);
    }

    /**
     * @Route("/new", name="offrir_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offrir = new Offrir();
        $form = $this->createForm(OffrirType::class, $offrir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offrir);
            $entityManager->flush();

            return $this->redirectToRoute('offrir_index');
        }

        return $this->render('offrir/new.html.twig', [
            'offrir' => $offrir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="offrir_show", methods={"GET"})
     */
    public function show(Offrir $offrir): Response
    {
        return $this->render('offrir/show.html.twig', [
            'offrir' => $offrir,
        ]);
    }

    /**
     * @Route("/{visMatricule}/edit", name="offrir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offrir $offrir): Response
    {
        $form = $this->createForm(OffrirType::class, $offrir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offrir_index', [
                'visMatricule' => $offrir->getVisMatricule(),
            ]);
        }

        return $this->render('offrir/edit.html.twig', [
            'offrir' => $offrir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="offrir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offrir $offrir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offrir->getVisMatricule(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offrir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offrir_index');
    }
}
