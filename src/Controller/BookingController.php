<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController {

    #[Route("/user-booking", name: "user_booking")]
    public function createBooking(Request $request, ManagerRegistry $doctrine): Response {
        $booking = new Booking();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($booking);
            $em->flush();
            $this->addFlash('success', 'Réservation validée.');
            return $this->redirectToRoute("dish_selection");
        }

        return $this->render('booking/create.html.twig', [
            "form" => $form
        ]);
    }


}