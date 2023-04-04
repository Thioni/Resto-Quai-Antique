<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController {

    #[Route("/", name: "dish_selection")]
    public function getSelection(): Response {
        return $this->render('dish/welcome.html.twig');
    }


    #[Route("/dish-list", name: "dish_list")]
    public function getAll(): Response {
        return $this->render('dish/list.html.twig');
    }

}