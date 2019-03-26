<?php

namespace App\Controller;

use App\Entity\Inviter;
use App\Form\InviterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inviter")
 */
class InviterController extends AbstractController
{
    /**
     * @Route("/", name="inviter_index", methods={"GET"})
     */
    public function index(): Response
    {
        $inviters = $this->getDoctrine()
            ->getRepository(Inviter::class)
            ->findAll();

        return $this->render('inviter/index.html.twig', [
            'inviters' => $inviters,
        ]);
    }

    /**
     * @Route("/new", name="inviter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inviter = new Inviter();
        $form = $this->createForm(InviterType::class, $inviter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inviter);
            $entityManager->flush();

            return $this->redirectToRoute('inviter_index');
        }

        return $this->render('inviter/new.html.twig', [
            'inviter' => $inviter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="inviter_show", methods={"GET"})
     */
    public function show(Inviter $inviter): Response
    {
        return $this->render('inviter/show.html.twig', [
            'inviter' => $inviter,
        ]);
    }

    /**
     * @Route("/{acNum}/edit", name="inviter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inviter $inviter): Response
    {
        $form = $this->createForm(InviterType::class, $inviter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inviter_index', [
                'acNum' => $inviter->getAcNum(),
            ]);
        }

        return $this->render('inviter/edit.html.twig', [
            'inviter' => $inviter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{acNum}", name="inviter_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inviter $inviter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inviter->getAcNum(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inviter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inviter_index');
    }
}
