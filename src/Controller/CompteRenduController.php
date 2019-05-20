<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\RapportVisite;
use App\Form\RapportVisiteType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\RapportVisiteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class CompteRenduController extends AbstractController
{
    
    public function index(Request $request,  PaginatorInterface $paginator)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getVisMatricule();
        $rapQ = $this->getDoctrine()->getRepository(RapportVisite::class)->findBy(array('visMatricule'=>$user));
        
        if($request->query->getAlnum('filter1')){
            $rapQ
            ->where('r.rapNum LIKE :rapNum')
            ->setParameter('rapNum','%' . $request->query->getAlnum('filter') . '%');        
        }
        if($request->query->getAlnum('filter2')){
            $rapQ
            ->where('r.praNum LIKE :praNum')
            ->setParameter('praNum','%' . $request->query->getAlnum('filter2') . '%');
        }
        if($request->query->getAlnum('filter3')){
            $rapQ
            ->where('r.rapDate LIKE :rapDate')
            ->setParameter('rapDate','%' . $request->query->getAlnum('filter3') . '%');    
        }
        if($request->query->getAlnum('filter4')){
            $rapQ
            ->where('r.rapBilan LIKE :rapBilan')
            ->setParameter('rapBilan','%' . $request->query->getAlnum('filter3') . '%');
        }
        if($request->query->getAlnum('filter5')){
            $rapQ
            ->where('r.rapMotif LIKE :rapMotif')
            ->setParameter('rapMotif','%' . $request->query->getAlnum('filter3') . '%');
        }
        
       

        $rapport = $paginator->paginate(
            // Doctrine Query, not results
            $rapQ,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            6
            );
        
        return $this->render('compte_rendu/index.html.twig', [
            'rapport' => $rapport,
        ]);
    }
}
