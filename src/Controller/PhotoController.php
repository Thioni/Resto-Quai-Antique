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
    public function addPhoto(Request $request, ManagerRegistry $doctrine) : Response {
        $photo = new Photo();

        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();

            if ($photo->isSelected()) {
                $dishPhotos = $doctrine->getRepository(Photo::class)
                ->findBy(['dish' => $photo->getDish()]);

                foreach ($dishPhotos as $dishPhoto) {
                    if ($photo->getId() === $dishPhoto->getId()) {
                        continue;
                    }
                    $dishPhoto->setSelected(false);
                    $em->persist($dishPhoto);
                }
            }

            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute("dish_list");
        }

        return $this->render('photo/add.html.twig', [
            "form" => $form
        ]);

    }
}