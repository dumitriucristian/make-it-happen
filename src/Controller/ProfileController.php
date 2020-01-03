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

            //$wishes = $user->getWishes();
           // dump($wishes);
            $form = $this->createForm(ProfileType::class, $user);
            //$repository = $this->getDoctrine()->getRepository(Wish::class);
            //$userWish = $repository->findBy('id_user_id');
            $form->handleRequest($request);


            if ($form->isSubmitted()) {
                $em->persist($user);
                $em->flush();
            }

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView()
        ]);
    }




}
