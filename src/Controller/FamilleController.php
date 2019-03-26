<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Form\FamilleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille")
 */
class FamilleController extends AbstractController
{
    /**
     * @Route("/", name="famille_index", methods={"GET"})
     */
    public function index(): Response
    {
        $familles = $this->getDoctrine()
            ->getRepository(Famille::class)
            ->findAll();

        return $this->render('famille/index.html.twig', [
            'familles' => $familles,
        ]);
    }

    /**
     * @Route("/new", name="famille_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('famille_index');
        }

        return $this->render('famille/new.html.twig', [
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{famCode}", name="famille_show", methods={"GET"})
     */
    public function show(Famille $famille): Response
    {
        return $this->render('famille/show.html.twig', [
            'famille' => $famille,
        ]);
    }

    /**
     * @Route("/{famCode}/edit", name="famille_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Famille $famille): Response
    {
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('famille_index', [
                'famCode' => $famille->getFamCode(),
            ]);
        }

        return $this->render('famille/edit.html.twig', [
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{famCode}", name="famille_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Famille $famille): Response
    {
        if ($this->isCsrfTokenValid('delete'.$famille->getFamCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($famille);
            $entityManager->flush();
        }

        return $this->redirectToRoute('famille_index');
    }
}
