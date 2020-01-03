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

        $wish = new Wish();
        $form = $this->createForm(AddWishType::class, $wish);
        $user = $this->getUser();


        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $data = $form->getData();
            $wish->setUser($user);
            $em->persist($wish);
            $em->flush();

        }


        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit-wish/{id}", name="edit-wish")
     * @param Request $request
     * @param EntityManagerInterface $em
     */

    public function edit(Request $request, EntityManagerInterface $em, $id)
    {
        $wish = $em->getRepository(Wish::class)->find($id);
        $form = $this->createForm(AddWishType::class, $wish);
        $user = $this->getUser();


        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $data = $form->getData();
            $wish->setUser($user);
            $em->persist($wish);
            $em->flush();

        }
        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/remove-wish/{id}", name="remove-wish")
     * @param Request $request
     * @param EntityManagerInterface $em
     */

    public function remove(Request $request, EntityManagerInterface $em, $id)
    {
        $wish = $em->getRepository(Wish::class)->find($id);
        $em->remove($wish);
        $em->flush();

        $this->addFlash(
            'notice',
            'Wish has been deleted!'
        );

        return $this->redirectToRoute('/',[ ] );
    }


}
