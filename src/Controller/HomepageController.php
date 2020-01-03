<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WishRepository;
use App\Entity\Wish;


class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="/")
     */
    public function index(EntityManagerInterface $em)
    {

       // $repository = $this->getDoctrine()->getRepository(Wish::class);
        //$wishes = $repository->findAll();

        return $this->render('homepage/homepage.html.twig',[
            'wishes' => []
        ]);
    }


}
