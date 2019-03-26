<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presentation")
 */
class PresentationController extends AbstractController
{
    /**
     * @Route("/", name="presentation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $presentations = $this->getDoctrine()
            ->getRepository(Presentation::class)
            ->findAll();

        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentations,
        ]);
    }

    /**
     * @Route("/new", name="presentation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $presentation = new Presentation();
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presentation);
            $entityManager->flush();

            return $this->redirectToRoute('presentation_index');
        }

        return $this->render('presentation/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{preCode}", name="presentation_show", methods={"GET"})
     */
    public function show(Presentation $presentation): Response
    {
        return $this->render('presentation/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    /**
     * @Route("/{preCode}/edit", name="presentation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Presentation $presentation): Response
    {
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presentation_index', [
                'preCode' => $presentation->getPreCode(),
            ]);
        }

        return $this->render('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{preCode}", name="presentation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Presentation $presentation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getPreCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($presentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presentation_index');
    }
}
