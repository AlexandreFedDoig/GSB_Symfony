<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RapportVisite;
use App\Form\RapportVisiteType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;

class CompteRenduController extends AbstractController
{
    /**
     * @Route("/compte/rendu", name="compte_rendu")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $rapport = new RapportVisite();
        
        $form = $this->createForm(RapportVisiteType::class, $rapport);
        
        $form->handlerequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($rapport);
            $manager->flush();
            
        }
         
        return $this->render('compte_rendu/index.html.twig', [
            'controller_name' => 'CompteRenduController',
            'formRap' => $form->createView()
        ]);
    }
    
}
