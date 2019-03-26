<?php

namespace App\Controller;

use App\Entity\Travailler;
use App\Form\TravaillerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/travailler")
 */
class TravaillerController extends AbstractController
{
    /**
     * @Route("/", name="travailler_index", methods={"GET"})
     */
    public function index(): Response
    {
        $travaillers = $this->getDoctrine()
            ->getRepository(Travailler::class)
            ->findAll();

        return $this->render('travailler/index.html.twig', [
            'travaillers' => $travaillers,
        ]);
    }

    /**
     * @Route("/new", name="travailler_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $travailler = new Travailler();
        $form = $this->createForm(TravaillerType::class, $travailler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($travailler);
            $entityManager->flush();

            return $this->redirectToRoute('travailler_index');
        }

        return $this->render('travailler/new.html.twig', [
            'travailler' => $travailler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="travailler_show", methods={"GET"})
     */
    public function show(Travailler $travailler): Response
    {
        return $this->render('travailler/show.html.twig', [
            'travailler' => $travailler,
        ]);
    }

    /**
     * @Route("/{visMatricule}/edit", name="travailler_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Travailler $travailler): Response
    {
        $form = $this->createForm(TravaillerType::class, $travailler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('travailler_index', [
                'visMatricule' => $travailler->getVisMatricule(),
            ]);
        }

        return $this->render('travailler/edit.html.twig', [
            'travailler' => $travailler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{visMatricule}", name="travailler_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Travailler $travailler): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travailler->getVisMatricule(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($travailler);
            $entityManager->flush();
        }

        return $this->redirectToRoute('travailler_index');
    }
}
