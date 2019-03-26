<?php

namespace App\Controller;

use App\Entity\Realiser;
use App\Form\RealiserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/realiser")
 */
class RealiserController extends AbstractController
{
    /**
     * @Route("/", name="realiser_index", methods={"GET"})
     */
    public function index(): Response
    {
        $realisers = $this->getDoctrine()
            ->getRepository(Realiser::class)
            ->findAll();

        return $this->render('realiser/index.html.twig', [
            'realisers' => $realisers,
        ]);
    }

    /**
     * @Route("/new", name="realiser_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $realiser = new Realiser();
        $form = $this->createForm(RealiserType::class, $realiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realiser);
            $entityManager->flush();

            return $this->redirectToRoute('realiser_index');
        }

        return $this->render('realiser/new.html.twig', [
            'realiser' => $realiser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="realiser_show", methods={"GET"})
     */
    public function show(Realiser $realiser): Response
    {
        return $this->render('realiser/show.html.twig', [
            'realiser' => $realiser,
        ]);
    }

    /**
     * @Route("/{acNum}/edit", name="realiser_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Realiser $realiser): Response
    {
        $form = $this->createForm(RealiserType::class, $realiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realiser_index', [
                'acNum' => $realiser->getAcNum(),
            ]);
        }

        return $this->render('realiser/edit.html.twig', [
            'realiser' => $realiser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="realiser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Realiser $realiser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realiser->getAcNum(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($realiser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('realiser_index');
    }
}
