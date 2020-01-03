<?php

namespace App\Controller;

use App\Form\AddWishType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Wish;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {

        $wish = new wish();
        $form = $this->createForm(AddWishType::class, $wish);
        $user = $this->getUser();


        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $data = $form->getData();
            $wish->setIdUser($user);
            $em->persist($wish);
            $em->flush();

        }


        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
            'form' => $form->createView()
        ]);
    }
}
