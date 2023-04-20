<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use App\Repository\PhotoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController {

    #[Route("/", name: "dish_selection")]
    public function getSelection(DishRepository $repo, PhotoRepository $photoRepo): Response {
        $dishes = $repo->findAll();
        $photos = $photoRepo->findBy(["selected" => true]);

        $selectedPhoto = [];
        foreach ($dishes as $dish) {
            foreach ($photos as $photo) {
                if ($photo->getDish()->getId() === $dish->getId()) {
                    $selectedPhoto[$dish->getId()] = $photo;
                    break;
                }
            }
        }

        return $this->render('dish/welcome.html.twig', [
            "dishes" => $dishes,
            "selectedPhoto" => $selectedPhoto,
        ]);
    }


    #[Route("/dish-list", name: "dish_list")]
    public function getAll(DishRepository $repo): Response {
        $dishes = $repo->findAll();
        return $this->render('dish/list.html.twig', [
            "dishes" => $dishes,
        ]);
    }

    #[Route("admin/create-dish", name: "create_dish")]
    public function create(Request $request, ManagerRegistry $doctrine): Response {
        $dish = new Dish();

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($dish);
            $em->flush();
            $this->addFlash('success', sprintf('%s ajouté à la liste.', $dish->getName()));
            return $this->redirectToRoute("dish_list");
        }

        return $this->render('dish/create.html.twig', [
            "form" => $form
        ]);
    }

    #[Route("admin/update-dish/{id}", name: "update_dish")]
    public function update(Request $request, ManagerRegistry $doctrine, Dish $dish): Response {

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();
            $this->addFlash('success', sprintf('%s a été modifié.', $dish->getName()));
            return $this->redirectToRoute("dish_list");
        }

        return $this->render('dish/create.html.twig', [
            "form" => $form,
            "dish" => $dish
        ]);
    }

    #[Route("admin/delete-dish/{id}", name: "delete_dish")]
    public function delete(ManagerRegistry $doctrine, Dish $dish) : Response {

        $em = $doctrine->getManager();
        $em->remove($dish);
        $em->flush();
        return $this->redirectToRoute("dish_list");
    }

}