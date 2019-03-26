<?php

namespace App\Controller;

use App\Entity\Formuler;
use App\Form\FormulerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formuler")
 */
class FormulerController extends AbstractController
{
    /**
     * @Route("/", name="formuler_index", methods={"GET"})
     */
    public function index(): Response
    {
        $formulers = $this->getDoctrine()
            ->getRepository(Formuler::class)
            ->findAll();

        return $this->render('formuler/index.html.twig', [
            'formulers' => $formulers,
        ]);
    }

    /**
     * @Route("/new", name="formuler_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formuler = new Formuler();
        $form = $this->createForm(FormulerType::class, $formuler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formuler);
            $entityManager->flush();

            return $this->redirectToRoute('formuler_index');
        }

        return $this->render('formuler/new.html.twig', [
            'formuler' => $formuler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="formuler_show", methods={"GET"})
     */
    public function show(Formuler $formuler): Response
    {
        return $this->render('formuler/show.html.twig', [
            'formuler' => $formuler,
        ]);
    }

    /**
     * @Route("/{medDepotlegal}/edit", name="formuler_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formuler $formuler): Response
    {
        $form = $this->createForm(FormulerType::class, $formuler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formuler_index', [
                'medDepotlegal' => $formuler->getMedDepotlegal(),
            ]);
        }

        return $this->render('formuler/edit.html.twig', [
            'formuler' => $formuler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{medDepotlegal}", name="formuler_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formuler $formuler): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formuler->getMedDepotlegal(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formuler);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formuler_index');
    }
}
