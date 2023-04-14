<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends AbstractController {

    #[Route("admin/add-photo", name: "add_photo")]
    public function create(Request $request, ManagerRegistry $doctrine) : Response {
    $photo = new Photo();

    $form = $this->createForm(PhotoType::class, $photo);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $doctrine->getManager();

        $dishPhotos = $doctrine->getRepository(Photo::class)
            ->findBy(['dish' => $photo->getDish()]);
        if (count($dishPhotos) >= 3) {
            $this->addFlash('error', 'Vous ne pouvez pas avoir plus de 2 photos par plat.');
        } else {
            if ($photo->isSelected()) {
                foreach ($dishPhotos as $dishPhoto) {
                    if ($photo->getId() === $dishPhoto->getId()) {
                        continue;
                    }
                    $dishPhoto->setSelected(false);
                }
            }

            $em->persist($photo);
            $em->flush();

            $this->addFlash('success', 'Photo added successfully!');
            return $this->redirectToRoute("dish_list");
        }
    }

    return $this->render('photo/add.html.twig', [
        "form" => $form
    ]);
}
}