<?php

namespace App\Controller;

use App\Entity\Posseder;
use App\Form\PossederType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posseder")
 */
class PossederController extends AbstractController
{
    /**
     * @Route("/", name="posseder_index", methods={"GET"})
     */
    public function index(): Response
    {
        $posseders = $this->getDoctrine()
            ->getRepository(Posseder::class)
            ->findAll();

        return $this->render('posseder/index.html.twig', [
            'posseders' => $posseders,
        ]);
    }

    /**
     * @Route("/new", name="posseder_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $posseder = new Posseder();
        $form = $this->createForm(PossederType::class, $posseder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($posseder);
            $entityManager->flush();

            return $this->redirectToRoute('posseder_index');
        }

        return $this->render('posseder/new.html.twig', [
            'posseder' => $posseder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{praNum}", name="posseder_show", methods={"GET"})
     */
    public function show(Posseder $posseder): Response
    {
        return $this->render('posseder/show.html.twig', [
            'posseder' => $posseder,
        ]);
    }

    /**
     * @Route("/{praNum}/edit", name="posseder_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Posseder $posseder): Response
    {
        $form = $this->createForm(PossederType::class, $posseder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('posseder_index', [
                'praNum' => $posseder->getPraNum(),
            ]);
        }

        return $this->render('posseder/edit.html.twig', [
            'posseder' => $posseder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{praNum}", name="posseder_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Posseder $posseder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$posseder->getPraNum(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($posseder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('posseder_index');
    }
}
