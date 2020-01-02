<?php

namespace App\Controller;

use App\Form\ProfileType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(EntityManagerInterface $em, Request $request)
    {

            $user = $this->getUser();
            $form = $this->createForm(ProfileType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
               $em->flush();
        }




        //if user does not has birthdate and username
        //create and show personal data form


        //if user has birtdate and username
        //display username




        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView()
        ]);
    }


}
