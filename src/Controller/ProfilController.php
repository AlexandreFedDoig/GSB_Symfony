<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            
            $form = $this->createForm(UserType::class, $user);
            
            $form->handlerequest($request);
            
            
            if(($form->isSubmitted() && $form->isValid())){
                
                $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
                
                
                $manager->merge($user);
                $manager->flush();
                return $this->RedirectToRoute('accueil');
                    
            }
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'formProfil' => $form->createView()
        ]);
       }
    }
    
}
