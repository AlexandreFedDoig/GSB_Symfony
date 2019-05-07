<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Praticien;
use App\Repository\PraticienRepository;

class PraticienController extends AbstractController
{
    /**
     * @Route("/praticien", name="praticien")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getRepository(Praticien::class);
        $praticiens = $em->findAll();
        
        return $this->render('praticien/index.html.twig', [
            'praticiens' => $praticiens,
        ]);
    }
    
}
