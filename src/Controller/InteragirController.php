<?php

namespace App\Controller;

use App\Entity\Interagir;
use App\Form\InteragirType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/interagir")
 */
class InteragirController extends AbstractController
{
    /**
     * @Route("/", name="interagir_index", methods={"GET"})
     */
    public function index(): Response
    {
        $interagirs = $this->getDoctrine()
            ->getRepository(Interagir::class)
            ->findAll();

        return $this->render('interagir/index.html.twig', [
            'interagirs' => $interagirs,
        ]);
    }

    /**
     * @Route("/new", name="interagir_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $interagir = new Interagir();
        $form = $this->createForm(InteragirType::class, $interagir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($interagir);
            $entityManager->flush();

            return $this->redirectToRoute('interagir_index');
        }

        return $this->render('interagir/new.html.twig', [
            'interagir' => $interagir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medPerturbateur}", name="interagir_show", methods={"GET"})
     */
    public function show(Interagir $interagir): Response
    {
        return $this->render('interagir/show.html.twig', [
            'interagir' => $interagir,
        ]);
    }

    /**
     * @Route("/{medPerturbateur}/edit", name="interagir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Interagir $interagir): Response
    {
        $form = $this->createForm(InteragirType::class, $interagir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('interagir_index', [
                'medPerturbateur' => $interagir->getMedPerturbateur(),
            ]);
        }

        return $this->render('interagir/edit.html.twig', [
            'interagir' => $interagir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medPerturbateur}", name="interagir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Interagir $interagir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$interagir->getMedPerturbateur(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($interagir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('interagir_index');
    }
}
