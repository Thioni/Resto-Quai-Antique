<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController {

    #[Route("/create-user", name: "create_user")]
    public function createBooking(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $userPasswordHasher): Response {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                  $user,
                  $form->get('password')->getData()
                )
              );

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Mail de confirmation envoyé');
            return $this->redirectToRoute("app_login");
        }

        return $this->render('user/create.html.twig', [
            "form" =>$form
        ]);

    }

}