<?php

namespace App\Controller;

use App\Entity\ActiviteCompl;
use App\Form\ActiviteComplType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activite/compl")
 */
class ActiviteComplController extends AbstractController
{
    /**
     * @Route("/", name="activite_compl_index", methods={"GET"})
     */
    public function index(): Response
    {
        $activiteCompls = $this->getDoctrine()
            ->getRepository(ActiviteCompl::class)
            ->findAll();

        return $this->render('activite_compl/index.html.twig', [
            'activite_compls' => $activiteCompls,
        ]);
    }

    /**
     * @Route("/new", name="activite_compl_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activiteCompl = new ActiviteCompl();
        $form = $this->createForm(ActiviteComplType::class, $activiteCompl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteCompl);
            $entityManager->flush();

            return $this->redirectToRoute('activite_compl_index');
        }

        return $this->render('activite_compl/new.html.twig', [
            'activite_compl' => $activiteCompl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="activite_compl_show", methods={"GET"})
     */
    public function show(ActiviteCompl $activiteCompl): Response
    {
        return $this->render('activite_compl/show.html.twig', [
            'activite_compl' => $activiteCompl,
        ]);
    }

    /**
     * @Route("/{acNum}/edit", name="activite_compl_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActiviteCompl $activiteCompl): Response
    {
        $form = $this->createForm(ActiviteComplType::class, $activiteCompl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activite_compl_index', [
                'acNum' => $activiteCompl->getAcNum(),
            ]);
        }

        return $this->render('activite_compl/edit.html.twig', [
            'activite_compl' => $activiteCompl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="activite_compl_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActiviteCompl $activiteCompl): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activiteCompl->getAcNum(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activiteCompl);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activite_compl_index');
    }
}
