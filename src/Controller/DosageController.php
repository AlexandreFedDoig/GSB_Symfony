<?php

namespace App\Controller;

use App\Entity\Dosage;
use App\Form\DosageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dosage")
 */
class DosageController extends AbstractController
{
    /**
     * @Route("/", name="dosage_index", methods={"GET"})
     */
    public function index(): Response
    {
        $dosages = $this->getDoctrine()
            ->getRepository(Dosage::class)
            ->findAll();

        return $this->render('dosage/index.html.twig', [
            'dosages' => $dosages,
        ]);
    }

    /**
     * @Route("/new", name="dosage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dosage = new Dosage();
        $form = $this->createForm(DosageType::class, $dosage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dosage);
            $entityManager->flush();

            return $this->redirectToRoute('dosage_index');
        }

        return $this->render('dosage/new.html.twig', [
            'dosage' => $dosage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{dosCode}", name="dosage_show", methods={"GET"})
     */
    public function show(Dosage $dosage): Response
    {
        return $this->render('dosage/show.html.twig', [
            'dosage' => $dosage,
        ]);
    }

    /**
     * @Route("/{dosCode}/edit", name="dosage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dosage $dosage): Response
    {
        $form = $this->createForm(DosageType::class, $dosage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dosage_index', [
                'dosCode' => $dosage->getDosCode(),
            ]);
        }

        return $this->render('dosage/edit.html.twig', [
            'dosage' => $dosage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{dosCode}", name="dosage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dosage $dosage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dosage->getDosCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dosage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dosage_index');
    }
}
