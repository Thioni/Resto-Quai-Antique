<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController {

    #[Route("/", name: "dish_selection")]
    public function getSelection(): Response {
        return $this->render('dish/welcome.html.twig');
    }


    #[Route("/dish-list", name: "dish_list")]
    public function getAll(DishRepository $repo): Response {
        $dishes = $repo->findAll();
        return $this->render('dish/list.html.twig', [
            "dishes" => $dishes,
        ]);
    }

    #[Route("/create-dish", name: "create_dish")]
    public function create(Request $request): Response {
        $dish = new Dish();

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Dump temporaire à supprimer //
            dump($dish);
            return $this->redirectToRoute("dish_list");
        }

        return $this->render('dish/create.html.twig', [
            "form" => $form
        ]);
    }

}