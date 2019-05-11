<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Praticien;
use App\Repository\PraticienRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class PraticienController extends AbstractController
{
    /**
     * @Route("/praticien", name="praticien")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $praticiensQ = $this->getDoctrine()->getRepository(Praticien::class)->getAll();
        
        if($request->query->getAlnum('filter')){
            $praticiensQ
                ->where('s.typCode LIKE :typCode')
                ->setParameter('typCode','%' . $request->query->getAlnum('filter') . '%');
                
        }
        
        if($request->query->getAlnum('filter2')){
            $praticiensQ
            ->where('s.praVille LIKE :praVille')
            ->setParameter('praVille','%' . $request->query->getAlnum('filter2') . '%');
            
        }
        
        if($request->query->getAlnum('filter3')){
            $praticiensQ
            ->where('s.praNom LIKE :praNom')
            ->setParameter('praNom','%' . $request->query->getAlnum('filter3') . '%');
            
        }
        
        
        $praticiens = $paginator->paginate(
            // Doctrine Query, not results
            $praticiensQ,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            6
            );
        
        return $this->render('praticien/index.html.twig', [
            'praticiens' => $praticiens,
        ]);
    }
    
    /**
     * @Route("/praticien/{id}", name="details")
     * 
     * @IsGranted("ROLE_USER")
     */
    public function show($id){
        $em = $this->getDoctrine()->getRepository(Praticien::class);
        $prat = $em->find($id);
        
        return $this->render('praticien/show.html.twig', [
            'prat' => $prat,
        ]);
        
    }
    
}
