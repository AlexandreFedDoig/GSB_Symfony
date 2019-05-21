<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\RapportVisite;
use App\Entity\Praticien;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class CompteRenduController extends AbstractController
{
    
    public function index(Request $request,  PaginatorInterface $paginator)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getVisMatricule();
        $rapQ = $this->getDoctrine()->getRepository(RapportVisite::class)->findBy(array('visMatricule'=>$user));
        
        $allPra = $this->getDoctrine()->getRepository(Praticien::Class)->findAll();
        foreach($allPra as $p) {
            $tabPra[$p->getPraNum()] = $p->getPraNom().' '.$p->getPraPrenom();
        }
        
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
            'pra' => $tabPra,
        ]);
    }
    
    /**
     * @Route("/compte-rendu/create", name="compte_rendu_creation")
     */
    public function create(Request $request, ObjectManager $manager) {
        
            $rapport = new RapportVisite();
            
            $allPra = $this->getDoctrine()->getRepository(Praticien::Class)->findAll();
            foreach($allPra as $p) {
                $choix[$p->getPraNom().' '.$p->getPraPrenom()] = $p->getPraNum();
            }
            
            $form = $this->createFormBuilder($rapport)
                            ->add('praNum', ChoiceType::class, [
                                'choices' => $choix,
                            ])  
                            ->add('rapBilan', null, [
                                'required'   => true
                            ])
                            ->add('rapMotif', null, [
                                'required'   => true
                            ])
                            ->getForm();
            
            
            $form->handlerequest($request);    
            $user = $this->get('security.token_storage')->getToken()->getUser()->getVisMatricule();
            $num = count($this->getDoctrine()->getRepository(RapportVisite::class)->findBy(array('visMatricule'=>$user)))+1;
            
            if($form->isSubmitted() && $form->isValid()){
                $rapport->setVisMatricule($this->get('security.token_storage')->getToken()->getUser()->getVisMatricule());
                $rapport->setRapDate(new \DateTime('now'));
                $rapport->setRapNum($num);
                
                $manager->persist($rapport);
                $manager->flush();
                
                return $this->RedirectToRoute('compte_rendu');
            }
            
            return $this->render('compte_rendu/create.html.twig', [
                'formRap' => $form->createView()
            ]);
    }
    
    
    /**
     * @Route("/compte-rendu/{id}", name="compte_rendu_show")
     */
    public function show(Request $request, ObjectManager $manager, $id) {
        
        //$rapport = new RapportVisite();
        $user = $this->get('security.token_storage')->getToken()->getUser()->getVisMatricule();
        $rapport = $this->getDoctrine()->getRepository(RapportVisite::class)->findOneBy(array('visMatricule'=>$user, 'rapNum'=>$id));
        
        $rapBilanOld = $rapport->getRapBilan();
        $rapMotifOld = $rapport->getRapMotif();
        
        $allPra = $this->getDoctrine()->getRepository(Praticien::Class)->findAll();   
        
        foreach($allPra as $p) {
            $choix[$p->getPraNom().' '.$p->getPraPrenom()] = $p->getPraNum();
        }
        
        
        
        $form = $this->createFormBuilder($rapport)
        ->add('praNum', ChoiceType::class, [
            'choices' => $choix,
        ])
        ->add('rapBilan')
        ->add('rapMotif')
        ->getForm();
        
       
        
        $form->handlerequest($request);    
       
      
        
        if($form->isSubmitted() && $form->isValid()){
            if (!($rapport->getRapBilan() == $rapBilanOld && $rapMotifOld == $rapport->getRapMotif())) {
                $rapport->setRapDate(new \DateTime('now'));
            }
                    
            
            
        $manager->persist($rapport);
        $manager->flush();
            
            return $this->RedirectToRoute('compte_rendu');
        }
        
        return $this->render('compte_rendu/show.html.twig', [
            'formRap' => $form->createView(),
            'rapport' => $rapport
        ]);
    }
}
